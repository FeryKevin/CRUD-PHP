<?php


/* CONNEXION BASE DE DONNEES */

function ConnectB($DB)
{
    return mysqli_connect("localhost","root","root",$DB);
}

$conn = ConnectB("lyceestvincent");


/* INSERT */

if (isset($_POST["submit"]))
{
    $id = $_POST['id'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom']; 
    $libelleClasse = $_POST['libelleClasse'];
    $libelle = $_POST['libelle'];
    
    $insert = mysqli_query($conn, "INSERT INTO eleve VALUES ('$id','$nom','$prenom','$libelleClasse','$libelle')") or die(mysqli_error($conn));
    $r = mysqli_query($conn, $insert) or die(mysqli_error($conn));
}


/* UPDATE */

if (isset($_POST["update"]))
{
    $nom = $_POST['nom'];
    $old_nom = $_POST['old_nom']; 
     
    $prenom = $_POST['prenom'];
    $old_prenom = $_POST['old_prenom']; 
    
    
    $libelle = $_POST['libelle'];
    $old_libelle = $_POST['old_libelle'];
        
    $libelleClasse = $_POST['libelleClasse'];
    $old_libelleClasse = $_POST['old_libelleClasse']; 
    
    
    $update = "UPDATE eleve SET nom='$nom', prenom='$prenom', fk_id_materiel='$libelle', fk_id_classe='$libelleClasse' WHERE nom='$old_nom' AND prenom='$old_prenom' AND fk_id_materiel='$old_libelle' AND fk_id_classe='$old_libelleClasse'";
    $r = mysqli_query($conn, $update) or die(mysqli_error($conn));    
}


/* DELETE */

if (isset($_POST["delete"]))
{   
    $nom = $_POST['nom']; 
    $prenom = $_POST['prenom']; 
    
    $delete = "DELETE FROM eleve where nom='$nom' AND prenom='$prenom'";
    $r = mysqli_query($conn, $delete) or die(mysqli_error($var));
}


?>
<!DOCTYPE html>
<html>
    <head>
        <title>Projet php</title>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <script src="js/script.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/style.css">
    </head>
    
    <body>
        
        <section id="formulaire">
            <h2 class="h2Form">Formulaire</h2>          
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        
                        <form role='form' class="formulaire" method="post">
                            
                            <!-- input id eleve du formulaire -->
                            
                            <label for='id' class="labelFormulaire">ID</label>
                            <input type='text' id="id" name="id" class='form-control' placeholder="id"> 
                            
                            <!-- input nom du formulaire -->
                            
                            <label for="nom" class="labelFormulaire">Nom :</label>
                            <input type="text" id="nom" name="nom" class="form-control" placeholder="nom">
        
                            <!-- input prénom du formulaire -->
                            
                            <label for="prenom" class="labelFormulaire">Prénom :</label>
                            <input type="text" id="prenom" name="prenom" class="form-control" placeholder="prenom">
        
                            <!-- input classe du formulaire -->
                            
                            <label for="libelleClasse" class="labelFormulaire">Classe :</label>
                            <select name='libelleClasse' class='form-control'>
                                <option value="1">BTS 1</option>
                                <option value="2">BTS 2</option>
                                <option value="3">TERMINAL 1</option>
                                <option value="4">TERMINAL 2</option>
                                <option value="5">TERMINAL 3</option>
                                <option value="6">TERMINAL 4</option>
                            </select>
                            
                            <!-- input libelle materiel du formulaire -->
                                                     
                            <label for="libelle" class="labelFormulaire">Libelle du materiel :</label>
                            <select name='libelle' class='form-control'>
                                <option value="1">HP ELITEBOOK G230</option>
                                <option value="2">HP ELITEBOOK G231</option>
                                <option value="3">ASUS ROG GAMER</option>
                                <option value="4">LENOVO AYD500</option>
                                <option value="5">DELL LATITUDE D500</option>
                                <option value="6">DELL LATITUDE D600</option>
                            </select>          
                            
                            <!-- bouton insert du formulaire -->
                            
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <input type="submit" name="submit" class="buttonf" value="Ajouter">
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>  
        </section>

        <!-- tableau view -->
        
        <table class="table table-bordered">
            <tr>
                <th>Nom</th>
                <th>Prenom</th>
                <th>Classe</th>
                <th>Materiel</th> 
                <th>Modifier</th>
                <th>Supprimer</th>
            </tr>
            
            <?php 

            /* selectionner tous les éléments d'une table */

            $req = mysqli_query ($conn, "Select * From eleve") or die(mysqli_error($conn));
            while ($row =  mysqli_fetch_assoc($req))  
            {
                echo "<tr>";  
                echo "<td>".$row ['nom']."</td>";
                echo "<td>".$row ['prenom']."</td>";

                /* table 2 */

                $req2 = mysqli_query ($conn, "Select libelle From classe WHERE id='".$row['id']."'") or die(mysqli_error($conn));

                $row2 =  mysqli_fetch_assoc($req2);

                echo "<td>".$row2 ['libelle']."</td>"; 
                     
                /* table 3 */

                $req3 = mysqli_query ($conn, "Select libelle From materiel WHERE id='".$row['id']."'") or die(mysqli_error($conn));

                $row3 =  mysqli_fetch_assoc($req3);

                echo "<td>".$row3 ['libelle']."</td>";
                
                /* lien modal update */
                
                echo "<td><a href='' data-toggle='modal' class='button-1' data-target='#Modif".$row['id']."'>Modifier</a></td>";
                
                /* lien modal delete */
                    
                echo "<td><a href='' data-toggle='modal' class='button-1' data-target='#Suppr".$row['id']."'>Supprimer</a></td>";
                
                /* fermeture tableau */

                echo "</tr>";
                
            ?> 
            
            <!-- modal delete -->
            
            <div class="modal fade" id="Suppr<?php echo $row['id']; ?>">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">x</button>
                            <h3 class="modal-title">Suppression</h3>
                        </div>

                        <form class='form' class='formulaire' method="post" name="formDelete">
                            
                            <input type='hidden' name='prenom' value="<?php echo $row['prenom']; ?>">
                            <input type='hidden' name='nom' value="<?php echo $row['nom']; ?>">
                            
                            <h5>Êtes-vous sûr(e) de vouloir supprimer ?</h5>

                            <div class='container-fluid' id='soumettre'>
                                <button type='submit' class='btn btn-primary' id="delete" name="delete"> Oui</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal" class="fermer"> Non</button>
                            </div>
                        </form>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal" class="fermer">Fermer</button>
                        </div>
                    </div>
                </div>
             </div>
            
            <!-- modal update -->
            
            <div class="modal fade" id="Modif<?php echo $row['id']; ?>">
                <div class="modal-dialog">
                    <div class="modal-content">
            
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">x</button>
                            <h3 class="modal-title">Modification</h3>
                        </div>
            
                        <!-- formulaire modal modification -->
                        
                        <form class='form' class='formulaire' method="post" name="formUpdate">
                            
                            <!-- label nom  -->
                            
                            <div class='form-group'>
                                <label for='nom'>Nom</label>
                                <input type='text' name='nom' class='form-control' placeholder="Nom" value="<?php echo $row['nom']; ?>">
                            </div>
                            
                            <!-- label prénom  -->
                            
                            <div class='form-group'>
                                <label for='prenom'>Prénom</label>
                                <input type='text' name='prenom' class='form-control' placeholder="Prénom" value="<?php echo $row['prenom']; ?>">
                            </div>
                            
                            <!-- label libelleClasse  -->    
                            
                            <div class='form-group'>
                                <label for='libelleClasse'>Classe</label>
                                <select name='libelleClasse' class='form-control'>
                                    <option value="1">BTS 1</option>
                                    <option value="2">BTS 2</option>
                                    <option value="3">TERMINAL 1</option>
                                    <option value="4">TERMINAL 2</option>
                                    <option value="5">TERMINAL 3</option>
                                    <option value="6">TERMINAL 4</option>
                                </select>
                            </div>

                            <!-- label libelle  -->
                            
                            <div class='form-group'>
                                <label for='libelle'>Materiel</label>
                                <select name='libelle' class='form-control'>
                                    <option value="1">HP ELITEBOOK G230</option>
                                    <option value="2">HP ELITEBOOK G231</option>
                                    <option value="3">ASUS ROG GAMER</option>
                                    <option value="4">LENOVO AYD500</option>
                                    <option value="5">DELL LATITUDE D500</option>
                                    <option value="6">DELL LATITUDE D600</option>
                                </select>
                            </div>
                                                 
                            <!-- bouton valider pour le update avec le changement de valeur-->
                            
                            <div class='container-fluid' id='soumettre'>
                                <button type='submit' class='btn btn-sucess' id='update' name='update'> Modifier</button>
                            </div>
                            
                            <input type='hidden' name='old_nom' value="<?php echo $row['nom']; ?>">
                            
                            <input type='hidden' name='old_prenom' value="<?php echo $row['prenom']; ?>">
                            
                            <input type='hidden' name='old_libelleClasse' value="<?php echo $row['fk_id_classe']; ?>">
                            
                            <input type='hidden' name='old_libelle' value="<?php echo $row['fk_id_materiel']; ?>">
                            
                        </form>

                        <div class="modal-footer">
                            <button type="button" classe="btn btn-default" data-dismiss="modal" class="fermer">Fermer</button>
                        </div>
                    </div>
                </div>
            </div>
            
            <?php    
            }
            ?>
            
         </table>
    </body>  
</html>