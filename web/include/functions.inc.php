<?php
require_once "./include/connexion_bd.php"
?>




<?php
    function  register(){
        echo "<div class=<\"content\">";
        echo "<span></span>";
        echo "<input type=\"text\" name=\"client_id\" placeholder=\"INE/ID PERSONNEL:\" minlength=\"11\" maxlength=\"11\" required>";
        echo "<i class=\"fa fa-envelope\"></i>";
        echo "</div>";

        echo "<br></br>";

        echo "<div class=\"content\">";
        echo "<span></span>";
        echo "<input type=\"text\" name=\"nom\" placeholder=\"Nom:\" required>";
        echo "<i class=\"fa fa-lock\"></i>";
        echo "</div>";

        echo "<div class=\"content\">";
        echo "<span></span>";
        echo "<input type=\"text\" name=\"prenom\" placeholder=\"Prénom:\" required>";
        echo "<i class=\"fa fa-envelope\"></i>";
        echo "</div>";

        echo "<br></br>";

        echo "<div class=\"content\">";
        echo "<span></span>";
        echo "<input type=\"tel\" id=\"phone\" name=\"phone\" placeholder=\"00 00 00 00 00\" pattern=\"[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}\" minlength=\"10\" maxlength=\"10\" required>";
        echo "<br>";
        echo "<i class=\"fa fa-lock\"></i>";
        echo "</div>";

        echo "<div class=\"content\">";
        echo "<span></span>";
        echo "<input type=\"text\" name=\"nationalite\" placeholder=\"Nationalité:\" required>";
        echo "<i class=\"fa fa-envelope\"></i>";
        echo "</div>";

        echo "<div class=\"content\">";
        echo "<span></span>";
        echo "<input type=\"email\" name=\"email\" placeholder=\"Mail:\" required>";
        echo "<i class=\"fa fa-envelope\"></i>";
        echo "</div>";

        echo "<br></br>";
        echo "<div class=\"content\">";
        echo "<span></span>";
        echo "<input type=\"text\" name=\"adresse\" placeholder=\"Adresse:\" required>";
        echo "<i class=\"fa fa-lock\"></i>";
        echo "</div>";

        echo "<div class=\"content\">";
        echo "<span></span>";
        echo "<input type=\"text\" name=\"birthday\" placeholder=\"YYYY-MM-JJ\" pattern=\"(?:19|20)(?:[0-9]{2}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-8])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:29|30))|(?:(?:0[13578]|1[02])-31))|(?:[13579][26]|[02468][048])-02-29)\" minlength=\"10\" maxlength=\"10\" required>";
        echo "<i class=\"fa fa-envelope\"></i>";
        echo "</div>";

        

    }

    function register_pwd(){
        echo "<div class=\"content\">";
        echo "<span></span>";
        echo "<input type=\"password\" name=\"password\" placeholder=\"Mot de passe:\"  minlength=\"4\" required>";
        echo "<i class=\"fa fa-envelope\"></i>";
        echo "</div>";
    }

    function register_staff(){
        register();
        echo "<div class=\"content\">";
        echo "<span></span>";
        echo "<label for=\"lieu_travail\">Entrez votre lieu de travail :</label>";
        echo "<select id=\"lieu_travail\" name=\"lieu_travail\">";
        echo "<option value=\"CHENE\">Chêne</option>";
        echo "<option value=\"NEUVILLE\">Neuville</option>";
        echo "<option value=\"ST-MARTIN\">St-Martin</option>";
        echo "</select>";
        echo "<i class=\"fa fa-envelope\"></i>";
        echo "</div>";
        register_pwd();
    }


    function register_student(){
        register();
        echo "<div class=\"content\">";
        echo "<span></span>";
        echo "<input type=\"text\" name=\"annee_scolaire\" placeholder=\"YYYY-MM-JJ\"  pattern=\"(?:19|20)(?:[0-9]{2}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-8])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:29|30))|(?:(?:0[13578]|1[02])-31))|(?:[13579][26]|[02468][048])-02-29)\" minlength=\"10\" maxlength=\"10\" required>";
        echo "<i class=\"fa fa-envelope\"></i>";
        echo "</div>";

        echo "<br></br>";
        echo "<div class=\"content\">";
        echo "<span></span>";
        echo "<input type=\"radio\" id=\"is_boursier\" name=\"is_boursier\" value=\"98\">";
        echo "<label for=\"is_boursier\">Je suis boursier</label>";
        echo "<input type=\"radio\" id=\"is_not_boursier\" name=\"is_boursier\" value=\"1\">";
        echo "<label for=\"is_not_boursier\">Je ne suis pas boursier</label><br>";
        echo "<i class=\"fa fa-lock\"></i>";
        echo "</div>";
        register_pwd();

    }



    function get_id_client($email){
        global $db;
        $stmt = $db->prepare('SELECT id_client FROM client WHERE email = ? ;');
        $stmt->execute([$email]);

        $get_id_from_client = $stmt->fetch();

        return $get_id_from_client[0];
    }
   

    function hash_pwd($pwd){
        $options = ['cost' => 12,];

        $hashpass=password_hash($pwd, PASSWORD_BCRYPT, $options);
        return $hashpass;
    }

    function no_etu_random($length=6){
        $chars = '0123456789';
        $string = '22';
        for($i=0; $i<$length; $i++){
            $string .= $chars[rand(0, strlen($chars)-1)];
    }
    return $string;
    }

    function no_personnel_random($length=6){
        $chars = '0123456789';
        $string = '11';
        for($i=0; $i<$length; $i++){
            $string .= $chars[rand(0, strlen($chars)-1)];
    }
    return $string;
    }


    function show_client(){
        global $db;
        $stm = $db->query('SELECT * FROM client');

        // fetch all rows into array, by default PDO::FETCH_BOTH is used
        $rows = $stm->fetchAll();
            
        echo "<table><tr><th>Id_client</th><th>NOM</th><th>Prenom</th><th>Solde</th></tr>";
            
        foreach($rows as $row){
            echo "<tr>";

            echo "<td>".$row['id_client']."</td>\r\t\n";
            echo "<td>".$row['nom']."</td>\r\t\n";
            echo "<td>".$row['prenom']."</td>\r\t\n";
            echo "<td>".$row['solde']."</td>\r\t\n";

            echo "</tr>";
        }
        echo "</table>";
    }


    function show_solde($id){
        global $db;
        $stm = $db->prepare('SELECT * FROM client WHERE id_client=?');
        $stm->execute([$id]);

        // fetch all rows into array, by default PDO::FETCH_BOTH is used
        $rows = $stm->fetchAll();
            
        echo "<table><tr><th>Solde</th></tr>";
            
        foreach($rows as $row){
            echo "<tr>";
            echo "<td>".$row['solde']."</td>\r\t\n";

            echo "</tr>";
        }
        echo "</table>";
    }


    function show_solde_history($id){
        global $db;
        $stm = $db->prepare('SELECT id_client, nom, prenom, date_achat FROM achat INNER JOIN a_effectuer ON achat.id_achat=a_effectuer.id_achat_a_effectuer INNER JOIN client ON client.id_client=a_effectuer.id_client_a_effectuer   WHERE id_client=? LIMIT 30;'); //changer la jointure, ajouter date_achat, ajouter groupe_by pour les triés par rapport à la date en descendant avec une limit de 30
        $stm->execute([$id]);
        // fetch all rows into array, by default PDO::FETCH_BOTH is used
        $rows = $stm->fetchAll();
            
        echo "<table><tr><th>Id_client</th><th>NOM</th><th>Prenom</th><th>Solde</th></tr>";
            
        foreach($rows as $row){
            echo "<tr>";

            echo "<td>".$row['solde']."</td>\r\t\n";
            echo "<td>".$row['date_achat']."</td>\r\t\n";

            echo "</tr>";
        }
        echo "</table>";
    }

    



    

    function this_year(): int{
        global $db;
        $stmt = $db->query('SELECT DATE_PART(\'year\',NOW()::timestamp);');
        $rows = $stmt->fetchAll();

        foreach($rows as $row){
            $this_year = $row['date_part'];
        }
        return $this_year;
    }



    function birth_year($birth){
        global $db;
        $stmt = $db->prepare('SELECT DATE_PART(\'year\', ? ::timestamp);');
        $stmt-> execute([$birth]);
        $birth_year = $stmt->fetch();

        return $birth_year[0];
        
    }

    function age_today($email){
        $a=this_year();
        $b=birth_year($email);
        $age_today=$a-$b;
        return $age_today;
    }


    function show_profile($id){
        global $db;
        $stm = $db->prepare('SELECT * FROM client WHERE id_client= ?');
        $stm -> execute([$id]);

        // fetch all rows into array, by default PDO::FETCH_BOTH is used
        $rows = $stm->fetchAll();
            
        echo "<table><tr><th>Id_client</th><th>NOM</th><th>Prenom</th><th>Age</th><th>Code Tarif</th></tr>";
            
        foreach($rows as $row){
            echo "<tr>";

            echo "<td>".$row['id_client']."</td>\r\t\n";
            echo "<td>".$row['nom']."</td>\r\t\n";
            echo "<td>".$row['prenom']."</td>\r\t\n";
            echo "<td>".$row['age']."</td>\r\t\n";
            echo "<td>".$row['code_tarif']."</td>\r\t\n";

            echo "</tr>";
        }
        echo "</table>";
    }

    function send_client_sign_up($id_client,$nom,$prenom,$tel,$nationalite,$email,$age,$photo,$adresse,$date_naissance,$solde,$code_tarif,$mdp_hashe,$ref_academie){
        global $db;
        $sql_client = "INSERT INTO client (id_client,nom,prenom,tel,nationalite,email,age,photo,adresse,date_naissance,solde,code_tarif,mdp_hashe,ref_academie) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $stmt_client= $db->prepare($sql_client);
        $stmt_client->execute([$id_client,$nom,$prenom,$tel,$nationalite,$email,$age,$photo,$adresse,$date_naissance,$solde,$code_tarif,$mdp_hashe,$ref_academie]);
        
    }

    function send_student_sign_up($id_client,$no_etu,$nbr_abscence_nj,$redoublement,$annee_scolaire){
        global $db;
        $sql_student = "INSERT INTO etudiant (ine,no_etu,nbr_abscence_nj,redoublement,annee_scolaire) VALUES (?,?,?,?,?)";
        $stmt_student= $db->prepare($sql_student);
        $stmt_student->execute([$id_client,$no_etu,$nbr_abscence_nj,$redoublement,$annee_scolaire]);
        
    }

    function send_staff_sign_up($id_client,$no_personnel,$lieu_travail){
        global $db;
        $sql_staff = "INSERT INTO personnel (id_personnel,no_personnel,lieu_travail) VALUES (?,?,?)";
        $stmt_staff= $db->prepare($sql_staff);
        $stmt_staff->execute([$id_client,$no_personnel,$lieu_travail]);
        
    }

    function send_academie_sign_up($ref_academie,$nom_academie){
        global $db;
        $sql_academie = "INSERT INTO Academie (ref_academie,nom_academie) VALUES (?,?)";
        $stmt_academie= $db->prepare($sql_academie);
        $stmt_academie->execute([$ref_academie,$nom_academie]);
        
    }



    function value_append_account_form(){
        echo "<form action=\"#\" method=\"POST\">";
            echo "<div class=\"content\">";
            echo "<span></span>";
            echo "<label for=\"default_value\">Recharger :</label>";
            echo "<select id=\"default_value\" name=\"montant\">";
            echo "<option value=\"10\">10 €</option>";
            echo "<option value=\"20\">20 €</option>";
            echo "<option value=\"30\">30 €</option>";
            echo "<option value=\"50\">50 €</option>";
            echo "<option value=\"100\">100 €</option>";
            echo "<option value=\"200\">200 €</option>";
            echo "</select>";
            echo "<i class=\"fa fa-envelope\"></i>";
            echo "</div>";
            echo "<input type=\"submit\" value=\"Submit\">";
	    echo "</form>";
    }


    
    
    
    function append_monney($monney,$id) {
        global $db;
        $sql_append_monney = "UPDATE client SET solde= solde + ? WHERE id_client = ? ;";
        $stmt_monney= $db->prepare($sql_append_monney);
        $stmt_monney->execute([$monney,$id]);

    }






?>
