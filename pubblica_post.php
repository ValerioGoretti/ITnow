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
                        //$email= $_SESSION["email"];
                        $email='valerio.wp9@gmail.com';
                        $controllo=0;
                        

                        /*
                            Prendi id dell'anno didattico per utilizzarlo nell'insert del post
                        */
                        $dbconn = pg_connect("host=rogue.db.elephantsql.com port=5432 dbname=xsyvwldl user=xsyvwldl password=3GQ9zjDsifaXMFcQkLPrEdDM2lWiPGev");
                        $query_anno="SELECT ad.anno, corso, id, inizio, docente
                                    FROM public.anno_didattico as ad join anno_docente as adoc on ad.id=adoc.anno 
                                    where docente='$email'";
                        $result_anno = pg_query($dbconn,$query_anno) or die ('Query failed: '.pg_last_error());
                        while ($line  = pg_fetch_array($result_anno,null,PGSQL_ASSOC))
                        {
                          if($corso==$line['corso'] .' ' . $line['anno']){
                              $id_corso=$line['id'];
                          }
                        }
                        if($result_anno)
                            $controllo=1;
                        else
                            $msg="problema ricerca corso";
                        /*
                            Inserisci Post e prendi id  per utilizzarlo nell'insert del file
                        */

                        $query= "INSERT INTO public.post(
                            intestazione, testo, anno, docente)
                            VALUES ('$titolo', '$testo', '$id_corso', '$email' )
                            RETURNING id;";
                        $result = pg_query($dbconn,$query) or die ('Query failed: '.pg_last_error());
                        while ($line  = pg_fetch_array($result,null,PGSQL_ASSOC))
                        {
                          $id_post=$line['id'];
                        }
                        if($result){
                            if($controllo=1)
                                $controllo=2;
                            else
                                $msg= $msg .", problema caricamento post";
                        }

                        


                        /*
                            Scarica foto e inserisci nella tablla file
                        */



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
                                $ext = pathinfo($fileName, PATHINFO_EXTENSION);
                                
                                $query3="INSERT INTO file(
                                    post, name)
                                   VALUES ( $id_post, '$fileName')
                                   RETURNING id;";
                                $result3 = pg_query($dbconn,$query3) or die ('Query failed: '.pg_last_error());
                                while ($line  = pg_fetch_array($result3,null,PGSQL_ASSOC))
                                {
                                    $id_file=$line['id'];                
                                }
                                move_uploaded_file($file['tmp_name'], $uploadDir.DIRECTORY_SEPARATOR.$id_file.'.'.$ext);

                                $array=array('url'=> "$uploadDir/$id_file.$ext");
                                $condition=array('id'=>$id_file);
                                $res=pg_update($dbconn,'file',$array,$condition)or die ('Query failed: '.pg_last_error());
                                if ($res){
                                    if($controllo=2)
                                        $controllo=3;
                                    else
                                        $msg= $msg . ", problema caricamento file";
                                }
                            }
 
                        }

                        if($controllo=3)
                            $msg="post inviato correttamente";
                        header("Location: Home.php?messaggio=  $msg");

                        
                    }
                        
                       
                
                ?>
                
    
    </body>
</html>

