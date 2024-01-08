<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gift Card Redeem</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
<div class="container"> 

<div class="row">
<div class="col">
  
</div>
<div class="col-6">
  
<div class="card text-center">
  <div class="card-header">
    Redeem Gift Card
  </div>
  <br>
  <div class="card-body" >
    <form action="{{route('save')}}" method="post">
        @csrf
        <input type="text" name="gift_number" id="gnumber" class="form-control">
        <br><br>
        <a id="check_gnumber" class="btn btn-primary" style="text-align: center" href="javascript:void(0)">Redeem</a>
        <br><br>
        <hr>
        @if(Session::has('success'))
       <p class="alert alert-success">{{ Session::get('success') }}</p>
       @endif   
        <div id="response" style="text-align: right"></div>
        <div class="no_response" style="text-align: right"></div>
        <div id="balance" style="text-align: left"></div>
       <div style="text-align: left">
        
         <br><br>
        <label>Customer Number</label>
        <br>
        <input type="hidden" name="balance" id="balance_input" value="">
        <input type="text" name="customer_number" style="width:300px;">
        <button type="submit" class="btn btn-success" style="margin: 0px 0px 0px 50px;">Apply Payment</button>
        </div>
    </form>
  </div> <!--end of card-body-->
  
    </div>
</div>
<div class="col">
  
</div>

</div>
</div> 
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<script type="text/javascript">
    var username = "ck_ad713bc399f8d63da81a3583057b3e7b3d0899d4";
    var password = "cs_ee0259074bde553ce2008e6e0cd3994f99da77d5";
    
    
  $("#check_gnumber").click(function(){
    var gnumber = $('#gnumber').val();
   $.ajax({  
    url: 'https://etesting.space/wp-json/wc-pimwick/v1/pw-gift-cards',
    username : username,
    password :password,
    type: 'GET',
    contentType: 'application/x-www-form-urlencoded',
    dataType: "json",
    xhrFields: 
    {
        withCredentials: true
    },
    beforeSend: function (xhr) { 
        xhr.setRequestHeader('Authorization', 'Basic ' + btoa(username + ":" + password));      
    },
    success : function(data) {
    var datum=JSON.stringify(data);
     arr = $.parseJSON(datum); //convert to javascript array
    //console.log(arr)  
var item = arr.find(item => item.number === gnumber);
if(item != undefined)
{
    $('#balance').html("Balance: $ "+ parseInt(item.balance));
    $('#balance_input').val(parseInt(item.balance));
}


    let result = [{}];
    for (let key in arr) {
       for(let value in arr[key]) {
        if (!result[0][value]) { result[0][value] = [] } 
        result[0][value].push(arr[key][value]);
    }
}
// console.log(result);

$.each(result, function (index, data) { 
                   if ($.inArray(gnumber, data.number) == -1 ){
                        $('#response').html('The card is not valid').css("color", "red");
                        $('#balance').html("");
                    }
                    else{
                        $('#response').html('The card is valid').css("color", "green");;
                    }
    });
   },
   error: function (xhr,ajaxOptions,throwError){
    //Error block 
  },
});
});
</script> 
</body>
</html>
