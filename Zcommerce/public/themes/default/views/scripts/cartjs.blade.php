<script>


    function onaddtocartclick(id,qu)
    {
        alert(" HELLO world");
        var y = document.getElementById("quantity"+id);
        if(y==null)
        qu=1;
        else
        qu==parseInt(y.value);
        
      $.ajax({
          url: "{{route('cart.addItem')}}",
          type: 'POST',
          // dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
          data: {
            slug: id,
            quantity:qu,
            _token:'{{ csrf_token() }}'
          },
             success: function(response){
              console.log(response);
              alert(" HELLO");
            //   var dataResult = JSON.parse(response);
            //   if(dataResult.data=="login")
            //   window.location = "{{route('login')}}";
            //   else
            //   document.getElementById("addedtocarttext").innerHTML=dataResult.data;
              
              }
      });
    }
    </script>