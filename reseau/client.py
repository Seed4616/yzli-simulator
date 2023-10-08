# ----- 1 - IMPORTATIONS ------------------------------------
import socket
import sys

#Exemple d'id client a facturer:45215252813

# ----- 2 - CONSTANTES --------------------------------------
"""
CONSTANTE LIER A LA CONNEXION AU SERVEUR
"""
HOST = 'localhost'
PORT = 7470
# ----- 3 - FONCTIONS --------------------------------------
"""
FONCTION DE VERIFICATION DE L'ID AVANT ENVOIE
"""
def check_id(id):
    check = False
    while check == False:
        if id == "q":
            id+= "\r\n"
            print("Vous avez quitter")
            sys.exit()
        elif len(id) != 11 or (" " in id):
            id = input(print("ID Inccoret, veuillez entrer un ID de taille 11 (q pour quitter) ? \n"))
            print(id)
        else:
            check = True
    return id

# ----- 4 - PROGRAMME PRINCIPAL ------------------------------
"""
GESTION DE CONNEXION ET DE L'ENVOIE DES ID AU SERVEUR
"""
try:
    client_socket = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
    client_socket.connect((HOST, PORT))
    print("Client connecté !")
    while True:
        #récupération de l'id

        id = input(print("Quelle ID mange a la cantine (q pour quitter) ? \n"))
        id = check_id(id)
        out = (id+"\r\n").encode("utf8")

        if(client_socket.send(out)):
            print("ID: ", id, " a étais envoyé \n")
            del out
        else:
            print("SEND FAILD")
    client_socket.close()
except ConnectionRefusedError:
    print("Connection echouée")
