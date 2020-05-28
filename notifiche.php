<!doctype html>
<?php
    include 'updateDocentiJson.php';
    runDoc();
?>
    <head>
    <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">    
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
        
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <link rel="stylesheet" href="css/registrazione.css">
        <link href="css/profilo.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet"/>
        <link href="css/home.css" rel="stylesheet">
        <script src="https://use.fontawesome.com/releases/v5.13.0/js/all.js" crossorigin="anonymous"></script>
        <script type="text/javascript"src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
        <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
    <script>
         $("document").ready(function(){
                
               
                $('#clicca').click(function(){
                            
                            <?php $matricola=$_SESSION['matricola'];?>
                            $.ajax({
                            type: "POST",
                            url: "elabora-notifice.php",
                            dataType:"json",
                            data: {studente:'<?php echo $matricola;?>'},
                            
                            success: function(msg){
                                
                                console.log(msg);
                                
                                $('.dropdown-menu').html(msg.notifiche);
                                
                            }
                            
                            });  
                    
                 
                });
            });
 </script>
        
            
    
         


    </head>
    <body>
    <div class="rightBar font-weight-light" style="width:200px;padding:5px;color:white;">
    <div class="dropdown  font-weight-light" id="clicca">
    <button class="btn btn-secondary dropdown-toggle" style="background-color:white;" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-bell" id="clicca" style="font-size:50px;color:#822433;"></i>
    </button>
  <div class="dropdown-menu animate slideIn" aria-labelledby="dropdownMenuButton " style="width:100%;padding:5px">
    
    
  </div>
</div>
</div>
</body>