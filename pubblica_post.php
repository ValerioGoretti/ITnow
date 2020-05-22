<html>
<head>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <link rel="stylesheet" href="css/password_dimenticata.css">
        <link href="css/registrazione.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />

</head>
<body >
                <?php
                    
                    //include "updateDocentiJson.php";             
                    if(isset($_POST['pubblica'])){   
                        $corso=$_POST['corso'];
                        $titolo=$_POST['titolo'];
                        $testo=$_POST['testo'];
                        $email=$_SESSION['email'];
                        echo $corso;
                        $dbconn = pg_connect("host=rogue.db.elephantsql.com port=5432 dbname=xsyvwldl user=xsyvwldl password=3GQ9zjDsifaXMFcQkLPrEdDM2lWiPGev");
                        
                        $array=array('corso'=>$corso,'titolo'=>$titolo,'testo'=>$testo,'file'=>$file);
                        $query= "INSERT INTO public.post(
                            intestazione, testo, anno, docente)
                            VALUES ($titolo, $testo, $corso, $email )
                            RETURNING id;";
                        $result = pg_query($dbconn,$query) or die ('Query failed: '.pg_last_error());
                        while ($line  = pg_fetch_array($result,null,PGSQL_ASSOC))
                        {
                          $id_post=$line['id'];
                        }


                        echo $id_post;






                        $uploadDir = 'download';

                        function rearrange($files)
                        {
                            foreach($files as $key1 => $val1) {
                                foreach($val1 as $key2 => $val2) {
                                    for ($i = 0, $count = count($val2); $i < $count; $i++) {
                                        $newFiles[$i][$key2] = $val2[$i];
                                    }
                                }
                            }
                            return $newFiles;
                        }
                        
                        $files = rearrange($_FILES);

                        foreach ($files as $file) {
                            if (UPLOAD_ERR_OK === $file['error']) {
                                $fileName = basename($file['name']);
                                echo $fileName;
                                move_uploaded_file($file['tmp_name'], $uploadDir.DIRECTORY_SEPARATOR.$fileName);
                            }
                        }

                        
                        
                    }
                        
                       
                
                ?>
                
    
    </body>
</html>
