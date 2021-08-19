@extends('Layout.ProductPage.Product')
@section('content')
<div class="page-content">
    <div class="holder breadcrumbs-wrap mt-0">
        <div class="container">
            <ul class="breadcrumbs">
                <li><a href="{{Route('Home')}}">Home</a></li>
                <li><span>@@page</span></li>
            </ul>
        </div>
    </div>
    <div class="holder">
        <div class="container">
            <!-- Page Title -->
            <div class="page-title text-center">
                <div class="title">
                    <h1>Typography</h1>
                </div>
            </div>
            <!-- /Page Title -->
            <div class="row vert-margin-double justify-content-center">
                <div class="col-sm-9">
                    <h3 class="h-lined">Headings</h3>
                    <div class="headings-demo">
                        <h1>H1 HEADING</h1>
                        <h2>H2 HEADING</h2>
                        <h3>H3 HEADING</h3>
                        <h4>H4 HEADING</h4>
                        <h5>H5 HEADING</h5>
                        <h6>H6 HEADING</h6>
                    </div>
                    <div class="clearfix mt-4"></div>
                    <h3 class="h-lined">Blockquotes</h3>
                    <blockquote>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit.</p>
                    </blockquote>
                    <div class="clearfix mt-4"></div>
                    <h3 class="h-lined">Tables</h3>
                    <h4>Basic Table</h4>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Table heading</th>
                                <th>Table heading</th>
                                <th>Table heading</th>
                                <th>Table heading</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Table cell</td>
                                <td>Table cell</td>
                                <td>Table cell</td>
                                <td>Table cell</td>
                            </tr>
                            <tr>
                                <td>Table cell</td>
                                <td>Table cell</td>
                                <td>Table cell</td>
                                <td>Table cell</td>
                            </tr>
                            <tr>
                                <td>Table cell</td>
                                <td>Table cell</td>
                                <td>Table cell</td>
                                <td>Table cell</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <h4>Striped Rows</h4>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Table heading</th>
                            <th>Table heading</th>
                            <th>Table heading</th>
                            <th>Table heading</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Table cell</td>
                            <td>Table cell</td>
                            <td>Table cell</td>
                            <td>Table cell</td>
                        </tr>
                        <tr>
                            <td>Table cell</td>
                            <td>Table cell</td>
                            <td>Table cell</td>
                            <td>Table cell</td>
                        </tr>
                        <tr>
                            <td>Table cell</td>
                            <td>Table cell</td>
                            <td>Table cell</td>
                            <td>Table cell</td>
                        </tr>
                        </tbody>
                    </table>
                    <div class="clearfix mt-4"></div>
                    <h3 class="h-lined">Pagination</h3>
                    <ul class="pagination">
                        <li class="active"><a href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">4</a></li>
                        <li><a href="#">5</a></li>
                    </ul>
                    <div class="clearfix mt-4"></div>
                    <h3 class="h-lined">Social Icons</h3>
                    <ul class="social-list">
                        <li>
                            <a href="#" class="icon icon-facebook"></a>
                        </li>
                        <li>
                            <a href="#" class="icon icon-twitter"></a>
                        </li>
                        <li>
                            <a href="#" class="icon icon-google"></a>
                        </li>
                        <li>
                            <a href="#" class="icon icon-vimeo"></a>
                        </li>
                        <li>
                            <a href="#" class="icon icon-youtube"></a>
                        </li>
                        <li>
                            <a href="#" class="icon icon-pinterest"></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                    <div class="mt-4">
                        <ul class="social-list-circle">
                            <li>
                                <a href="#"><i class="icon-facebook"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="icon-twitter"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="icon-google"></i></a>
                            </li>
                            <li class="clearfix"></li>
                            <li>
                                <a href="#"><i class="icon-instagram"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="icon-fancy"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="icon-vimeo"></i></a>
                            </li>
                        </ul>
                        <ul class="social-list-circle-sm mt-2">
                            <li>
                                <a href="#"><i class="icon-facebook"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="icon-twitter"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="icon-google"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="icon-instagram"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="icon-fancy"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="icon-vimeo"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="icon-youtube"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="icon-pinterest"></i></a>
                            </li>
                        </ul>
                    </div>
                    <div class="clearfix mt-4"></div>
                    <h3 class="h-lined">Alerts</h3>
                    <div>
                        <div class="alert alert-success">
                            <strong>Success!</strong> Indicates a successful or positive action.
                        </div>
                        <div class="alert alert-info">
                            <strong>Info!</strong> Indicates a neutral informative change or action.
                        </div>
                        <div class="alert alert-warning">
                            <strong>Warning!</strong> Indicates a warning that might need attention.
                        </div>
                        <div class="alert alert-danger">
                            <strong>Danger!</strong> Indicates a dangerous or potentially negative action.
                        </div>
                    </div>
                </div>
                <div class="col-sm-9">
                    <a href="http://frontend.big-skins.com/foxic-html-demo/icon-foxic/demo.html" target="_blank" class="btn btn--lg w-100">Theme Icons Library</a>
                    <div class="mb-3"></div>
                    <h3 class="h-lined">Paragraph</h3>
                    <p><b>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip.</b></p>
                    <p><span class="text-marker">Lorem ipsum dolor</span> sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. <a href="#">Ut enim ad minim</a> veniam, quis <del>nostrud exercitation ullamco</del> <ins>laboris</ins> nisi ut aliquip.</p>
                    <p><i>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip.</i></p>
                    <div class="clearfix mt-4"></div>
                    <h3 class="h-lined">Buttons</h3>
                    <div>
                        <a href="#" class="btn btn--sm">Button</a>
                        <div class="mt-2"></div>
                        <a href="#" class="btn">Button</a>
                        <div class="mt-2"></div>
                        <a href="#" class="btn btn--lg">Button</a>
                        <div class="mt-2"></div>
                        <a href="#" class="btn btn--xl">Button</a>
                    </div>
                    <div class="clearfix mt-2"></div>
                    <div class="row vert-margin-small">
                        <div class="col-auto"><a href="#" class="btn">Button</a></div>
                        <div class="col-auto"><a href="#" class="btn btn--invert">Button</a></div>
                        <div class="col-auto"><a href="#" class="btn btn--grey">Button</a></div>
                    </div>
                    <div class="clearfix mt-2 mt-md-4"></div>
                    <h3 class="h-lined">Lists</h3>
                    <div class="row vert-margin">
                        <div class="col-sm-9">
                            <ul class="list list-marker">
                                <li>Lorem ipsum dolor sit</li>
                                <li>Amet, consectetur adipiscing</li>
                                <li>Elit, sed do eiusmod tempor</li>
                                <li>Adipiscing tempor ut vae</li>
                                <li>Incididunt ut labore</li>
                                <li>Dolore magna aliqua ut</li>
                            </ul>
                        </div>
                        <div class="col-sm-9">
                            <ul class="list-icon">
                                <li><i class="icon-info"></i>FoxShop</li>
                                <li><i class="icon-location"></i>Level 3 178 Clarence St, Jhenidah Australia</li>
                                <li><i class="icon-phone"></i>+3 800 555 35 35</li>
                                <li><i class="icon-watch"></i>7 Days a week</li>
                                <li><i class="icon-calendar"></i>09:00 am to 5:00 pm</li>
                            </ul>
                        </div>
                    </div>
                    <div class="clearfix mt-4"></div>
                    <h3 class="h-lined">Tooltip</h3>
                    <div class="row">
                        <div class="col">
                            <button class="btn" data-toggle="tooltip" data-placement="top" title="HOORAY!">Hover over me</button>
                            <div class="mt-2"></div>
                            <button class="btn" data-toggle="tooltip" data-placement="right" title="HOORAY!">Hover over me</button>
                        </div>
                        <div class="col">
                            <button class="btn" data-toggle="tooltip" data-placement="left" title="HOORAY!">Hover over me</button>
                            <div class="mt-2"></div>
                            <button class="btn" data-toggle="tooltip" data-placement="bottom" title="HOORAY!">Hover over me</button>
                        </div>
                    </div>
                    <div class="clearfix mt-4"></div>
                    <h3 class="h-lined">Forms</h3>
                    <form>
                        <div class="form-group">
                            <input type="text" class="form-control form-control--sm" placeholder="Input">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-control--sm form-control--error" placeholder="Input Error">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control form-control--sm" placeholder="Password">
                        </div>
                        <div class="form-group select-wrapper select-wrapper-sm">
                            <select class="form-control form-control--sm">
                                <option value="value1">SELECT</option>
                                <option value="value2">SELECT</option>
                                <option value="value3">SELECT</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control textarea--height-170" name="message" placeholder="Message" required></textarea>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="clearfix">
                                    <input id="checkbox1" name="checkbox1" type="checkbox" checked="checked">
                                    <label for="checkbox1">Checkbox 1</label>
                                </div>
                                <div class="clearfix">
                                    <input id="checkbox2" name="checkbox2" type="checkbox">
                                    <label for="checkbox2">Checkbox 2</label>
                                </div>
                                <div class="clearfix">
                                    <input id="checkbox3" name="checkbox3" type="checkbox">
                                    <label for="checkbox3">Checkbox 3</label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="clearfix">
                                    <input id="radio1" value="" name="radio3" type="radio" class="radio" checked="checked">
                                    <label for="radio1">Radio Button 1</label>
                                </div>
                                <div class="clearfix">
                                    <input id="radio2" value="" name="radio3" type="radio" class="radio">
                                    <label for="radio2">Radio Button 1</label>
                                </div>
                                <div class="clearfix">
                                    <input id="radio3" value="" name="radio3" type="radio" class="radio">
                                    <label for="radio3">Radio Button 1</label>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="clearfix mt-4"></div>
                    <h3 class="h-lined">Loaders</h3>
                    <div class="d-flex align-items-center justify-content-center" style="height: 120px;"><span class="foxic-loader"></span></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection()
