<?php

namespace App\Repositories\Bank;

use App\BankDetail;
use Illuminate\Http\Request;
use App\Repositories\BaseRepository;
use App\Repositories\EloquentRepository;

class EloquentBank extends EloquentRepository implements BaseRepository, BankRepository
{
	protected $model;

	public function __construct(BankDetail $bank_detail)
	{
		$this->model = $bank_detail;
	}

    public function all()
    {
        return $this->model->with('author','image')->orderBy('created_at', 'desc')->withCount('comments')->get();
    }

    public function trashOnly()
    {
        return $this->model->with('image')->orderBy('created_at', 'desc')->onlyTrashed()->get();
    }

    public function store(Request $request)
    {
        $blog = parent::store($request);

        if ($request->hasFile('image'))
            $blog->saveImage($request->file('image'));

        if ($request->input('tag_list'))
            $blog->syncTags($blog, $request->input('tag_list'));

        return $blog;
    }

    public function update(Request $request, $id)
    {
        $blog = parent::update($request, $id);

        $blog->syncTags($blog, $request->input('tag_list', []));

        if ($request->hasFile('image') || ($request->input('delete_image') == 1))
            $blog->deleteImage();

        if ($request->hasFile('image'))
            $blog->saveImage($request->file('image'));

        return $blog;
    }

	public function destroy($id)
	{
        $blog = parent::findTrash($id);

        $blog->detachTags($blog->id, 'blog');

        $blog->flushImages();

        return $blog->forceDelete();
	}
}