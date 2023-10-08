import java.sql.*;
import java.net.ServerSocket ;
import java.net.Socket ;
import java.io.IOException ;
import java.io.BufferedReader ;
import java.io.InputStreamReader ;
import java.io.PrintWriter ;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.PreparedStatement;
import java.util.Random;
import java.text.SimpleDateFormat;
import java.util.Date;


public class Server {
    public static void main (String argv []) throws IOException, ClassNotFoundException {

        //SOCKET
        ServerSocket serverSocket = null;
        serverSocket = new ServerSocket(7470);

        Socket clientSocket = null;


        System.out.println("################ ATTENTE D'UN CLIENT #################");
        try {
            clientSocket = serverSocket.accept();
            System.out.println("################ UN CLIENT EST CONNECTER #################");
        } catch (IOException e) {
            System.err.println("Accept echoue.");
            System.exit(1);
        }
        //BD connect
        Connection c = null;
        boolean listen = true;

        try {
            //étape 1: charger la classe de driver
            Class.forName("org.postgresql.Driver");
            c = DriverManager
                    .getConnection("jdbc:postgresql://postgresql-yzli.alwaysdata.net:5432/yzli_database", "yzli", "cybdreseau2223");

            System.out.println("=> Ouverture de la Base de donnée");


            PrintWriter flux_sortie = new PrintWriter(clientSocket.getOutputStream(), true);
            BufferedReader flux_entree = new BufferedReader(
                    new InputStreamReader(
                            clientSocket.getInputStream()));

            String chaine_entree, chaine_sortie;
            double paye = 3.30;
            double solde=0.0;
            int codeTarif=0;
            boolean bool_manger = false;
            boolean id_exist = false;
            Statement stmt = null;
      
            while ((chaine_entree = flux_entree.readLine()) != null) {
            	chaine_entree = chaine_entree.replace("\r\n", "");
                System.out.println("ID entrer : " + chaine_entree);
                if (chaine_entree.equals("q") || chaine_entree.length() != 11 || chaine_entree.contains(" ")) {
                    System.out.println("Vous avez quitter");
                    flux_sortie.println("Vous avez quitter");
                    flux_sortie.close();
                    flux_entree.close();
                    c.close();
                    clientSocket.close();
                    serverSocket.close();
                    break;

                } else {

                    //GENERER UN ID ACHAT


                    // Genere id_achat

                    String alphabet = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";

                    StringBuilder sb = new StringBuilder();

                    Random random = new Random();

                    for(int i = 0; i <11; i++) {
                        int index = random.nextInt(alphabet.length());
                        char randomChar = alphabet.charAt(index);
                        sb.append(randomChar);
                    }
                

                    String id_achat= sb.toString();
                    // FIN de generation d'un ID_Achat

                    //Recupéré la Date

                    SimpleDateFormat s = new SimpleDateFormat("yyyy-MM-dd");
                    Date date = new Date();
                    String today= s.format(date);

                    //Fin de recuperaction de la date

                    
                    System.out.println("Vous avez envoyé ID: " + chaine_entree);

                    //Le client existe t'il ?

                    stmt = c.createStatement();
                    ResultSet get_id_exist = stmt.executeQuery("SELECT EXISTS(SELECT id_client FROM client WHERE id_client='" + chaine_entree + "');");

                    while (get_id_exist.next()) {
                        id_exist = get_id_exist.getBoolean("exists");
                    }
                    
                    stmt.close();

                    //Obtenir le Solde Avant la facuration

                    stmt = c.createStatement();
                    ResultSet resultsolde = stmt.executeQuery("SELECT solde FROM client WHERE id_client='" + chaine_entree + "'");

                    while (resultsolde.next()) {
                        solde = resultsolde.getDouble("solde");
                    }
                    stmt.close();
                    System.out.println("Avant Facturation: " + solde);

                    //Le client a t'il manger aujourd'hui ?

                    stmt = c.createStatement();
                    ResultSet get_manger = stmt.executeQuery("SELECT EXISTS (SELECT DISTINCT id_client FROM achat \n" +
                            "INNER JOIN a_effectuer ON achat.id_achat = a_effectuer.id_achat_a_effectuer \n" +
                            "INNER JOIN client ON client.id_client = a_effectuer.id_client_a_effectuer \n" +
                            "WHERE id_client LIKE '" + chaine_entree + "' AND \n" +
                            "(SELECT DATE_PART('day','"+today+" 00:00:00'::timestamp - NOW()::timestamp) = 0));");

                    while (get_manger.next()) {
                        bool_manger = get_manger.getBoolean("exists");
                    }
                   
                    stmt.close();

                    //Recuperer le code tarif d'un client

                    stmt = c.createStatement();
                    ResultSet get_codeTarif = stmt.executeQuery("SELECT code_tarif FROM client WHERE id_client='" + chaine_entree + "'");
                    //étape 4: exécuter la requête
                    while (get_codeTarif.next()) {
                        codeTarif = get_codeTarif.getInt("code_tarif");
                    }

                    
                    stmt.close();

                    //Attribution de la valeur paye si Boursier
                    if(codeTarif==98 || codeTarif==90){paye=1.00;}


                    if (id_exist){
                        if (bool_manger == false){
                            if (solde >= paye) {   // Si il a acces d'argent pour son 2éme repas de la journée
                                //Facturation de 3.30€
                                stmt = c.createStatement();
                                String req_pay = "UPDATE client SET solde = solde-"+paye+" WHERE id_client='" + chaine_entree + "'";
                                stmt.executeUpdate(req_pay);
                                stmt.close();
                                System.out.println("ID : "+chaine_entree+" a étais facturé de"+paye);
                                

                                //Afficher le Solde apres facturation
                                stmt = c.createStatement();
                                resultsolde = stmt.executeQuery("SELECT solde FROM client WHERE id_client='" + chaine_entree + "'");
                                while (resultsolde.next()) {
                                    solde = resultsolde.getDouble("solde");
                                }
                                System.out.println("Apres Facuration: " + solde);
                               
                                stmt.close();

                                // INSERTION DE l'ACHAT
                                stmt = c.createStatement();
                                String sql_achat ="INSERT INTO achat ( id_achat, lieu_achat, date_achat,prix_achat,heure_achat)VALUES('"+id_achat+"','ST-MARTIN','"+today+"',"+paye+", NULL );";
                                stmt.executeUpdate(sql_achat);
                                stmt.close();

                                //INSERT DANS a_effectuer

                                stmt = c.createStatement();
                                String sql_aEffectuer ="INSERT INTO a_effectuer(id_achat_a_effectuer, id_client_a_effectuer)VALUES ('"+id_achat+"','"+chaine_entree+"');";
                                stmt.executeUpdate(sql_aEffectuer);
                                stmt.close();

                            }
                            else {
                                System.out.println("Vous n'avez pas assez, il vous faut minimun 3.30€");
                             
                            }
                        }
                        else if(bool_manger){
                        	paye = 3.30;
                        	if (solde >= 3.30) {
                        		//Facturation d'un client qui manque pour la 1er fois
                        		stmt = c.createStatement();
                        		String req_pay = "UPDATE client SET solde = solde-"+paye+" WHERE id_client='" + chaine_entree + "'";
                        		stmt.executeUpdate(req_pay);
                        		stmt.close();
                        		System.out.println("ID : "+chaine_entree+" a étais facturé de "+paye+"€");
                        		

                        		//Afficher le Solde apres facturation
                        		stmt = c.createStatement();
                        		resultsolde = stmt.executeQuery("SELECT solde FROM client WHERE id_client='" + chaine_entree + "'");
                        		while (resultsolde.next()) {
                        			solde = resultsolde.getDouble("solde");
                        		}
                        		System.out.println("Apres Facuration: " + solde+"€");
                        		
                        		stmt.close();

                        		// INSERTION DE l'ACHAT
                        		stmt = c.createStatement();
                        		String sql_achat ="INSERT INTO achat ( id_achat, lieu_achat, date_achat,prix_achat,heure_achat)VALUES('"+id_achat+"','ST-MARTIN','"+today+"',"+paye+", NULL );";
                        		stmt.executeUpdate(sql_achat);
                        		stmt.close();

                        		//INSERT DANS a_effectuer
                            
                        		stmt = c.createStatement();
                                String sql_aEffectuer ="INSERT INTO a_effectuer(id_achat_a_effectuer, id_client_a_effectuer)VALUES ('"+id_achat+"','"+chaine_entree+"');";
                                stmt.executeUpdate(sql_aEffectuer);
                                stmt.close();
                        	}
                        }
                        else {
                            System.out.println("Encaisement Echouer");
                            
                            System.out.println("#################  CLIENT SUIVANT EN ATTENTE ############");
                          
                        }
                    }
                    else {
                        System.out.println("L'ID client Fourni n'existe pas");
                        
                        System.out.println("#################  CLIENT SUIVANT EN ATTENTE ############");
                        
                    }

                }
            }
            flux_sortie.close();
            flux_entree.close();
            c.close();
            clientSocket.close();
            serverSocket.close();

        } catch (SQLException e) {
            throw new RuntimeException(e);
        }
    }}