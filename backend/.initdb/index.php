<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dislexia_trainer";

$conn = new mysqli($servername, $username, $password);
mysqli_set_charset($conn, "utf8");

if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) === TRUE) {
    echo "Database dislexia-trainer creato con successo\n";
} else {
    echo "Errore nella creazione del database: " . $conn->error;
}

$conn->select_db($dbname);

$sql = "CREATE TABLE IF NOT EXISTS `users` (
      `username` VARCHAR(255) PRIMARY KEY,
      `password` VARCHAR(255) NOT NULL,
      `name` VARCHAR(255) NOT NULL,
      `surname` VARCHAR(255) NOT NULL,
      `role` VARCHAR(255) NOT NULL
);";

if ($conn->query($sql) === TRUE) {
  echo "Tabella users creata con successo\n";
} else {
  echo "Errore nella creazione della tabella users: " . $conn->error;
}

$sql = "CREATE TABLE IF NOT EXISTS `texts` (
      `idText` INT AUTO_INCREMENT PRIMARY KEY,
      `text` TEXT NOT NULL,
      `level` INT NOT NULL
);";

if ($conn->query($sql) === TRUE) {
    echo "Tabella texts creata con successo\n";
} else {
    echo "Errore nella creazione della tabella texts: " . $conn->error;
}

$sql = "CREATE TABLE IF NOT EXISTS `attempts` (
      `idAttempt` INT AUTO_INCREMENT PRIMARY KEY,
      `username` VARCHAR(255) NOT NULL,
      `idText` INT NOT NULL,
      `dateAttempt` DATETIME NOT NULL,
      `time_elapsed` DOUBLE NOT NULL,
      `passed` BOOLEAN NOT NULL,
      FOREIGN KEY(username) REFERENCES users(username),
      FOREIGN KEY(idText) REFERENCES texts(idText)
);";

if ($conn->query($sql) === TRUE) {
    echo "Tabella attempt creata con successo\n";
} else {
    echo "Errore nella creazione della tabella attempt: " . $conn->error;
}

$sql = "INSERT IGNORE INTO `users` (`username`, `password`, `name`, `surname`, `role`) VALUES
        ('admin', '\$2y\$10\$Lsd.aOk6WkrJgaPWAJAskuZoe14isgxrKnTY5Bs6Fs8.Rmbkvq4Ee', 'admin', 'admin', 'Admin'),
        ('user0', '\$2y\$10\$ECUnK525e6J.XsigUvLIDeTIKbFmO71TZ1uRsbkeyqT95iccK4gOu', 'user0', 'user0', 'User'),
        ('user1', '\$2y\$10\$UlnPZAQxAFf7bD6Y.0p..ONKwScUpd/r4h5mxaTpzBdZK9tPYuX1G', 'user1', 'user1', 'User'),
        ('user2', '\$2y\$10\$3zf3qSX9jIJtPwqf/2euOeXqLVa6ZI5/temTNJDMVM05iksIOIV7C', 'user2', 'user2', 'User')
;";

if ($conn->query($sql) === TRUE) {
  echo "Dati della tabella users inseriti con successo\n";
} else {
  echo "Errore nell'inserimento dei dati nella tabella users: " . $conn->error;
}

$sql = "INSERT IGNORE INTO `texts` (`text`, `level`) VALUES
        ('Ciao', '1'),
        ('Amico', '1'),
        ('Parola', '1'),
        ('Cane', '1'),
        ('Gatto', '1'),
        ('Topolino', '1'),
        ('Semaforo', '1'),
        ('Macchina', '1'),
        ('Maestra', '1'),
        ('Mamma', '1'),
        ('Babbo', '1'),
        ('Fratello', '1'),
        ('Scoglio', '1'),
        ('Telefono', '1'),
        ('Zuppa', '1'),
        ('Musica', '1'),
        ('Maglietta', '1'),
        ('Orso', '1'),
        ('Bolla', '1'),
        ('Doccia', '1'),

        ('Sei mio amico', '2'),
        ('Simone parla', '2'),
        ('Ho fame', '2'),
        ('Mami e papi', '2'),
        ('Giochiamo a palla', '2'),
        ('Buona la pizza', '2'),
        ('Vado a scuola', '2'),
        ('Oggi sto bene', '2'),
        ('Andiamo al parco', '2'),
        ('Faccio i compiti', '2'),
        ('Mamma cucina', '2'),
        ('Il nonno dorme', '2'),
        ('Sei gentile', '2'),
        ('Guardo i cartoni', '2'),
        ('Brava mamma', '2'),
        ('Il cane bianco', '2'),
        ('Bella farfalla gialla', '2'),
        ('Tiro il dado', '2'),
        ('Sono innamorato', '2'),
        ('Che ore sono?', '2'),

        ('Guarda che bella giornata', '3'),
        ('La sedia di legno scomoda', '3'),
        ('Mio nonno legge il giornale', '3'),
        ('Il leone ruggisce forte', '3'),
        ('Il cane corre veloce', '3'),
        ('Mi piace il quadro blu', '3'),
        ('Il treno fischia e corre', '3'),
        ('Il bimbo mangia la frutta', '3'),
        ('Il mio computer funziona bene', '3'),
        ('Il cartone mi fa ridere', '3'),
        ('Quel cagnolino abbaia forte', '3'),
        ('La luna piena brilla', '3'),
        ('I lupi ululano', '3'),
        ('La penna blu mi piace', '3'),
        ('Domani vado al ristorante', '3'),
        ('Mio cugino si fa la bua', '3'),
        ('Vorrei essere un calciatore', '3'),
        ('La mia squadra ha vinto', '3'),
        ('Sono finito in prima pagina', '3'),
        ('La mamma mi ha dato un biscotto', '3'),

        ('In autunno le foglie degli alberi cadono', '4'),
        ('Nel cielo posso vedere tante stelline', '4'),
        ('La montagna si staglia imponente nel paesaggio', '4'),
        ('Il gatto dorme pacificamente sulla sedia', '4'),
        ('La farfalla si posa sui petali dei fiori', '4'),
        ('Il cucciolo tenero dorme abbracciato alla madre', '4'),
        ('Questo uccellino saluta il nuovo giorno dal ramo', '4'),
        ('Il fiore sboccia con grazia in mezzo al prato', '4'),
        ('Lo scienziato ha fatto una scoperta', '4'),
        ('Gli scoiattoli sono veloci e agili', '4'),
        ('Il castello antico evoca una misteriosa atmosfera', '4'),
        ('Oggi sono uscito di casa con una sciarpetta', '4'),
        ('Il mare tempestoso mette alla prova i marinai', '4'),
        ('La scienza ci permette di conoscere il mondo', '4'),
        ('Fra una settimana vedrai il mio criceto', '4'),
        ('Ho preso un bel voto nella verifica', '4'),
        ('Questo sciroppo ha un cattivo gusto', '4'),
        ('Mia sorella potrebbe essere allergica al glutine', '4'),
        ('In pianura si respira aria sana', '4'),
        ('Il fiume scorre rapido tra le rocce', '4'),

        ('Stavo giocando in giardino ma poi ha iniziato a piovere', '5'),
        ('Mentre la mamma preparava i biscotti, io studiavo', '5'),
        ('Se Marco mi da le caramelle, gli do un bacino', '5'),
        ('Il babbo dice sempre: prima il dovere, dopo il piacere', '5'),
        ('Apri la finestra che fa molto caldo in classe', '5'),
        ('Spegni la luce quando esci dal bagno', '5'),
        ('Devo prendere per la prima volta un aereo in vita mia', '5'),
        ('Ho cambiato immagine profilo con una nostra foto', '5'),
        ('In macchina bisogna essere sempre molto prudenti', '5'),
        ('Ho ancora fame, potrei avere un altro piatto di pasta?', '5'),
        ('Sono veloce come una gazzella, e forte come un gorilla', '5'),
        ('Ieri al cinema ho visto un film di Natale', '5'),
        ('Mamma corri che siamo in ritardo per la lezione', '5'),
        ('Mi sono dimenticato di mettere la sveglia', '5'),
        ('Ti volevo chiedere se ti andava di uscire insieme', '5'),
        ('Ordina le pizze da mangiare questa sera dal zio Cioci', '5'),
        ('La maestra ha sbagliato a fare un esercizio alla lavagna', '5'),
        ('Spero di riuscire a diventare maestro di scienze', '5'),
        ('Bisogna stare attenti a fare la raccolta differenziata', '5'),
        ('Sto studiando veramente tanto per passare questo esame', '5'),

        ('Mangiamo tutti quei biscotti che la nonna ha preparato nel forno caldo per noi', '6'),
        ('Facciamo una partita sul mio videogioco preferito e chi vince mangia la cioccolata', '6'),
        ('Sono pronto a sfidarti in creativa e a batterti per dimostrarti che sono forte', '6'),
        ('Anche se ho preso un brutto voto nella verifica, io so che mi sono impegnato', '6'),
        ('Le macchine buttano fuori molto gas cattivo, che inquina i nostri paesi', '6'),
        ('Le polveri sottili fanno molto male al nostro apparato respiratorio', '6'),
        ('Questo livello lo sto trovando davvero impegnativo e complicato da superare', '6'),
        ('La libellula verde e blu vola sui prati fioriti del parco comunale', '6'),
        ('Studiamo tutte le pagine di geografia e quando abbiamo finito andiamo a giocare', '6'),
        ('Nel mondo deve regnare la pace, siccome la guerra fa male e uccide molte persone', '6'),
        ('Il muratore che abbiamo pagato non mi sembra molto preparato nel suo lavoro', '6'),
        ('Mi hanno rubato la bicicletta e adesso devo andare in palestra a piedi', '6'),
        ('Senza occhiali vedo tutto molto male non riesco a leggere le frasi', '6'),
        ('Voglio diventare grande e andare nello spazio con un missile spaziale', '6'),
        ('Ero stanchissimo, quindi ho deciso di passare tutta la giornata a dormire', '6'),
        ('La mamma mette sempre il suo bellissimo rossetto rosso sulle labbra', '6'),
        ('Speriamo che domani nevichi, così posso fare un bel pupazzo di neve', '6'),
        ('Il tuo cagnolino bianco e marrone ha mangiato il mio panino al prosciutto', '6'),
        ('Babbo, il tuo telefono sta squillando. Credo che ti stia chiamando la mamma', '6'),
        ('Per utilizzare quella applicazione divertente, bisogna pagare molti soldi', '6'),

        ('Per colpa tua abbiamo perso il treno, e adesso ci tocca aspettare il prossimo che passa tra poche ore', '7'),
        ('Vieni alla lavagna a risolvere questa equazione. Se ci riesci senza errori ti metto un bel voto', '7'),
        ('Nel mio salvadanaio ho trovato tante monetine dorate e preziose che non ricordavo di avere', '7'),
        ('Devo ammettere che ho trovato la collanina di perle bianche e gialle della nonna molto bella', '7'),
        ('La spiaggia deserta si estende per chilometri, con le onde che si infrangono sulla sabbia dorata', '7'),
        ('Nella campagna verde, le mucche pascolano tranquille, mentre il contadino raccoglie il raccolto maturo', '7'),
        ('La pioggia battente crea pozzanghere sul marciapiede grigio, mentre la gente corre verso un riparo sicuro.', '7'),
        ('Nel bosco silenzioso, le foglie cadono lentamente e il vento sussurra tra i rami degli alberi', '7'),
        ('Il sole splende nel cielo azzurro e le rondini graziose volano leggere tra le nuvole bianche', '7'),
        ('La notte stellata regala uno spettacolo incantevole, con milioni di punti luminosi che illuminano il buio', '7'),
        ('Il vento soffia leggero, donando una piacevole sensazione di freschezza delicata sulla pelle', '7'),
        ('Il silenzio della notte viene interrotto solo dal suono delle cicale, creando una bella atmosfera suggestiva', '7'),
        ('I bambini piccoli giocano spensierati nel parco, ridendo e correndo tra le altalene e gli scivoli', '7'),
        ('I miei fratellini costruiscono castelli di sabbia sulla spiaggia, divertendosi con secchi e palette', '7'),
        ('Gli studenti ascoltano con attenzione le spiegazioni del professore, cercando di cogliere ogni dettaglio importante', '7'),
        ('Nella biblioteca della scuola, i ragazzi si immergono tra le pagine dei libri, alla ricerca di nuove conoscenze e avventure', '7'),
        ('Durante le presentazioni di gruppo, gli studenti si organizzano e collaborano per preparare un discorso convincente', '7'),
        ('I tifosi nello stadio si alzano in piedi, urlando e applaudendo quando la squadra segna un gol straordinario', '7'),
        ('Gli allenatori studiano strategie e schemi di gioco per dare alla loro squadra un vantaggio tattico durante le partite', '7'),
        ('I bambini nel parco giocherellano con il pallone, sognando di diventare campioni di calcio un giorno', '7'),

        ('Con il semaforo verde bisogna passare, con il giallo bisogna iniziare a fermarsi con molta attenzione e con il rosso ci si ferma', '8'),
        ('', '8'),
        ('', '8'),
        ('', '8'),
        ('', '8'),
        ('', '8'),
        ('', '8'),
        ('', '8'),
        ('', '8'),
        ('', '8'),
        ('', '8'),
        ('', '8'),
        ('', '8'),
        ('', '8'),
        ('', '8'),
        ('', '8'),
        ('', '8'),
        ('', '8'),
        ('', '8'),
        ('', '8'),

        ('', '9'),
        ('', '9'),
        ('', '9'),
        ('', '9'),
        ('', '9'),
        ('', '9'),
        ('', '9'),
        ('', '9'),
        ('', '9'),
        ('', '9'),
        ('', '9'),
        ('', '9'),
        ('', '9'),
        ('', '9'),
        ('', '9'),
        ('', '9'),
        ('', '9'),
        ('', '9'),
        ('', '9'),
        ('', '9'),

        ('Al pozzo dei pazzi una pazza lavava le pezze. Andò un pazzo e buttò la pazza con tutte le pezze nel pozzo dei pazzi', '10'),
        ('Li vuoi quei kiwi? E se non vuoi quei kiwi che kiwi vuoi?', '10'),
        ('Apelle figlio d\\'Apollo fece una palla di pelle di pollo, tutti i pesci vennero a galla per vedere la palla di pelle di pollo fatta da Apelle figlio d\\'Apollo', '10'),
        ('Trentatré trentini entrarono a Trento, tutti e trentatré di tratto in tratto trotterellando', '10'),
        ('A quest\\'ora il questore in questura non c\\'è', '10'),
        ('Una rara rana nera sulla rena errò una sera, una rara rana bianca sulla rena errò un po\\' stanca', '10'),
        ('Quel pazzo ha rubato un pizzo prezioso con un pezzo di pizza in un pozzo', '10'),
        ('Filastrocca sciogligrovigli con la lingua ti ci impigli ma poi te la sgrovigli basta che non te la pigli', '10'),
        ('Tre tigri contro tre tigri', '10'),
        ('Il Papa pesa e pesta il pepe a Pisa, Pisa pesa e pesta il pepe al Papa', '10'),
        ('Caro conte chi ti canta tanto canta che t\\'incanta', '10'),
        ('Una platessa lessa lesse la esse di Lessie su un calesse fesso', '10'),
        ('Tito, tu m\\'hai ritinto il tetto, ma non t\\'intendi tanto di tetti ritinti', '10'),
        ('A che serve che la serva si conservi la conserva, se la serva quando serve non si serve di conserva?', '10'),
        ('Il cuoco cuoce in cucina e dice che la cuoca giace e tace perché sua cugina non dica che le piace cuocere in cucina col cuoco', '10'),
        ('Sessantasei sassolini assetati e sassosi si assetarono ad Assisi', '10'),
        ('Se il coniglio gli agli ti piglia, levagli gli agli e tagliagli gli artigli', '10'),
        ('Sa chi sa se sa chi sa che se sa non sa se sa, sol chi sa che nulla sa ne sa più di chi ne sa', '10'),
        ('Se l\\'arcivescovo di Costantinopoli si disarcivescoviscostantinopolizzasse, tu ti disarcivescoviscostantinopolizzeresti come si è disarcivescoviscostantinopolizzato l\\'arcivescovo di Costantinopoli?', '10'),
        ('Sopra la panca la capra campa, sotto la panca la capra crepa', '10')
;";

if ($conn->query($sql) === TRUE) {
  echo "Dati della tabella texts inseriti con successo\n";
} else {
  echo "Errore nell'inserimento dei dati nella tabella texts: " . $conn->error;
}

$sql = "INSERT IGNORE INTO `attempts` (`idAttempt`, `username`, `idText`, `dateAttempt`, `time_elapsed`, `passed`) VALUES
        (0, 'MR2376', '00034', '2023-05-04', 1.25, 1),
        (0, 'CF1541', '00095', '2023-04-19', 2.56, 0),
        (0, 'CF1541', '00078', '2023-02-21', 0.32, 1)
;";

if ($conn->query($sql) === TRUE) {
  echo "Dati della tabella attempts inseriti con successo\n";
} else {
  echo "Errore nell'inserimento dei dati nella tabella attempts: " . $conn->error;
}