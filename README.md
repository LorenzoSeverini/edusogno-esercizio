# Edusogno Prova Tecnica

### Progetto sviluppato con PHP, Databse MySQL, CSS, HTML e Javascript.

### FIle della Documentazione del progetto

Link al file: [Documentazione.md](Documentazione.md)

### File brief del progetto

Link al file: [Task.pdf](Task-for-Edusogno.pdf)

## Funzione generale del progetto:

### User

- L'utente può registrarsi e accedere al sito, effettuare una richiesta di reset della password tramite un link inviato alla propria email e aprendolo potrà inserire una nuova password.

- L'utente effettuando il log in accede alla dasboard utente dove può visualizzare gli eventi a cui fa parte.

- L'utente può effettuare il log out.

### Admin

- L'admin è uno user con privilegi maggiori, tramite una Foreing Key è collegato alla tabella admin_privileges dove è presente un campo con id utente che fa riferimento alla tabella utenti. I privilegi possono essere dati solo attraverso l'azienda tramite un update del campo privileges nel database.

- L'admin effettua il log in dal form di Login e accede alla dashboard admin dove può visualizzare tutti gli eventi presenti nel database, può aggiungere un nuovo evento, modificare un evento esistente e cancellare un evento.

- L'admin può effettuare il log out.

