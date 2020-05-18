<!DOCTYPE html>
<html lang="en">
<head>
   
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <link href="css/home.css" rel="stylesheet">
        <title></title>
        <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v5.13.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic" rel="stylesheet" type="text/css" />
        <!-- Third party plugin CSS-->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
        
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
        
</head>

<body>
    <div class="core">
            <div class="spazioPost">
            
            <div class="parent">
                <!--scegli il corso-->
                <div class="div1">
                <input  type="text" placeholder="Scegli il corso dove inserire il post" autocomplete="off" list="corso" name="corso" class="corso" id="r" onchange="document.corsoform.submit();"/>
                <datalist id="corso" style="width:100%">
                    <option>prima opzione</option>
                    <option>seconda opzione</option>
                    <option>terza opzione</option>
                    <option>quarta opzione</option>
                </datalist>
                </div>
                <!--inserisci il titolo-->
                <div class="div2"><input type="text" class="creaTitolo" placeholder="Inserisci qui il titolo"></div>
                <!--scrivi il testo del post-->
                <div class="div3"><input type="text" class="creaTesto" placeholder="inserisci il testo"></div>
                <!--inserisci file-->
                <div class="div4"><input type="file" name="file" class="file" multiple></div>
            </div>
            </div>
    </div>  
        
    
    
</body>
</html>