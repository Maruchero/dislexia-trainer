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
		
		('Lavastoviglie', '2'),
        ('Apribottiglie', '2'),
        ('Cassaforte', '2'),
        ('Pianoforte', '2'),
        ('Benpensante', '2'),
        ('Malvivente', '2'),
        ('Tragicomico', '2'),
        ('Manomettere', '2'),
        ('Sottostimare', '2'),
        ('Psichiatra', '2'),
        ('Rmarro', '2'),
        ('Psicanalista', '2'),
        ('Parapiglia', '2'),
        ('Galantuomo', '2'),
        ('Psicologia', '2'),
        ('Soqquadro', '2'),
        ('Acquario', '2'),
        ('Tostapane', '2'),
        ('Capotreno', '2'),
        ('Altopiano', '2'),

        ('Sei mio amico', '3'),
        ('Simone parla', '3'),
        ('Ho fame', '3'),
        ('Mami e papi', '3'),
        ('Giochiamo a palla', '3'),
        ('Buona la pizza', '3'),
        ('Vado a scuola', '3'),
        ('Oggi sto bene', '3'),
        ('Andiamo al parco', '3'),
        ('Faccio i compiti', '3'),
        ('Mamma cucina', '3'),
        ('Il nonno dorme', '3'),
        ('Sei gentile', '3'),
        ('Guardo i cartoni', '3'),
        ('Brava mamma', '3'),
        ('Il cane bianco', '3'),
        ('Bella farfalla gialla', '3'),
        ('Tiro il dado', '3'),
        ('Sono innamorato', '3'),
        ('Che ore sono?', '3'),

        ('Guarda che bella giornata', '4'),
        ('La sedia di legno scomoda', '4'),
        ('Mio nonno legge il giornale', '4'),
        ('Il leone ruggisce forte', '4'),
        ('Il cane corre veloce', '4'),
        ('Mi piace il quadro blu', '4'),
        ('Il treno fischia e corre', '4'),
        ('Il bimbo mangia la frutta', '4'),
        ('Il mio computer funziona bene', '4'),
        ('Il cartone mi fa ridere', '4'),
        ('Quel cagnolino abbaia forte', '4'),
        ('La luna piena brilla', '4'),
        ('I lupi ululano', '4'),
        ('La penna blu mi piace', '4'),
        ('Domani vado al ristorante', '4'),
        ('Mio cugino si fa la bua', '4'),
        ('Vorrei essere un calciatore', '4'),
        ('La mia squadra ha vinto', '4'),
        ('Sono finito in prima pagina', '4'),
        ('La mamma mi ha dato un biscotto', '4'),

        ('In autunno le foglie degli alberi cadono', '5'),
        ('Nel cielo posso vedere tante stelline', '5'),
        ('La montagna si staglia imponente nel paesaggio', '5'),
        ('Il gatto dorme pacificamente sulla sedia', '5'),
        ('La farfalla si posa sui petali dei fiori', '5'),
        ('Il cucciolo tenero dorme abbracciato alla madre', '5'),
        ('Questo uccellino saluta il nuovo giorno dal ramo', '5'),
        ('Il fiore sboccia con grazia in mezzo al prato', '5'),
        ('Lo scienziato ha fatto una scoperta', '5'),
        ('Gli scoiattoli sono veloci e agili', '5'),
        ('Il castello antico evoca una misteriosa atmosfera', '5'),
        ('Oggi sono uscito di casa con una sciarpetta', '5'),
        ('Il mare tempestoso mette alla prova i marinai', '5'),
        ('La scienza ci permette di conoscere il mondo', '5'),
        ('Fra una settimana vedrai il mio criceto', '5'),
        ('Ho preso un bel voto nella verifica', '5'),
        ('Questo sciroppo ha un cattivo gusto', '5'),
        ('Mia sorella potrebbe essere allergica al glutine', '5'),
        ('In pianura si respira aria sana', '5'),
        ('Il fiume scorre rapido tra le rocce', '5'),

        ('Stavo giocando in giardino ma poi ha iniziato a piovere', '6'),
        ('Mentre la mamma preparava i biscotti, io studiavo', '6'),
        ('Se Marco mi da le caramelle, gli do un bacino', '6'),
        ('Il babbo diceche viene prima il dovere e dopo il piacere', '6'),
        ('Apri la finestra che fa molto caldo in classe', '6'),
        ('Spegni la luce quando esci dal bagno', '6'),
        ('Devo prendere per la prima volta un aereo in vita mia', '6'),
        ('Ho cambiato immagine profilo con una nostra foto', '6'),
        ('In macchina bisogna essere sempre molto prudenti', '6'),
        ('Ho ancora fame, potrei avere un altro piatto di pasta?', '6'),
        ('Sono veloce come una gazzella, e forte come un gorilla', '6'),
        ('Ieri al cinema ho visto un film di Natale', '6'),
        ('Mamma corri che siamo in ritardo per la lezione', '6'),
        ('Mi sono dimenticato di mettere la sveglia', '6'),
        ('Ti volevo chiedere se ti andava di uscire insieme', '6'),
        ('Ordina le pizze da mangiare questa sera dal zio Cioci', '6'),
        ('La maestra ha sbagliato a fare un esercizio alla lavagna', '6'),
        ('Spero di riuscire a diventare maestro di scienze', '6'),
        ('Bisogna stare attenti a fare la raccolta differenziata', '6'),
        ('Sto studiando veramente tanto per passare questo esame', '6'),

        ('Mangiamo tutti quei biscotti che la nonna ha preparato nel forno caldo per noi', '7'),
        ('Facciamo una partita sul mio videogioco preferito e chi vince mangia la cioccolata', '7'),
        ('Sono pronto a sfidarti in creativa e a batterti per dimostrarti che sono forte', '7'),
        ('Anche se ho preso un brutto voto nella verifica, io so che mi sono impegnato', '7'),
        ('Le macchine buttano fuori molto gas cattivo, che inquina i nostri paesi', '7'),
        ('Le polveri sottili fanno molto male al nostro apparato respiratorio', '7'),
        ('Questo livello lo sto trovando davvero impegnativo e complicato da superare', '7'),
        ('La libellula verde e blu vola sui prati fioriti del parco comunale', '7'),
        ('Studiamo tutte le pagine di geografia e quando abbiamo finito andiamo a giocare', '7'),
        ('Nel mondo deve regnare la pace, siccome la guerra fa male e uccide molte persone', '7'),
        ('Il muratore che abbiamo pagato non mi sembra molto preparato nel suo lavoro', '7'),
        ('Mi hanno rubato la bicicletta e adesso devo andare in palestra a piedi', '7'),
        ('Senza occhiali vedo tutto molto male non riesco a leggere le frasi', '7'),
        ('Voglio diventare grande e andare nello spazio con un missile spaziale', '7'),
        ('Ero stanchissimo, quindi ho deciso di passare tutta la giornata a dormire', '7'),
        ('La mamma mette sempre il suo bellissimo rossetto rosso sulle labbra', '7'),
        ('Speriamo che domani nevichi, così posso fare un bel pupazzo di neve', '7'),
        ('Il tuo cagnolino bianco e marrone ha mangiato il mio panino al prosciutto', '7'),
        ('Babbo, il tuo telefono sta squillando, credo che ti stia chiamando la mamma', '7'),
        ('Per utilizzare quella applicazione divertente, bisogna pagare molti soldi', '7'),

        ('Per colpa tua abbiamo perso il treno, e adesso ci tocca aspettare il prossimo che passa tra poche ore', '8'),
        ('Vieni alla lavagna a risolvere questa equazione, se ci riesci senza errori ti metto un bel voto', '8'),
        ('Nel mio salvadanaio ho trovato tante monetine dorate e preziose che non ricordavo di avere', '8'),
        ('Devo ammettere che ho trovato la collanina di perle bianche e gialle della nonna molto bella', '8'),
        ('La spiaggia deserta si estende per chilometri, con le onde che si infrangono sulla sabbia dorata', '8'),
        ('Nella campagna verde, le mucche pascolano tranquille, mentre il contadino raccoglie il raccolto maturo', '8'),
        ('La pioggia battente crea pozzanghere sul marciapiede grigio, mentre la gente corre verso un riparo sicuro', '8'),
        ('Nel bosco silenzioso, le foglie cadono lentamente e il vento sussurra tra i rami degli alberi', '8'),
        ('Il sole splende nel cielo azzurro e le rondini graziose volano leggere tra le nuvole bianche', '8'),
        ('La notte stellata regala uno spettacolo incantevole, con milioni di punti luminosi che illuminano il buio', '8'),
        ('Il vento soffia leggero, donando una piacevole sensazione di freschezza delicata sulla pelle', '8'),
        ('Il silenzio della notte viene interrotto solo dal suono delle cicale, creando una bella atmosfera suggestiva', '8'),
        ('I bambini piccoli giocano spensierati nel parco, ridendo e correndo tra le altalene e gli scivoli', '8'),
        ('I miei fratellini costruiscono castelli di sabbia sulla spiaggia, divertendosi con secchi e palette', '8'),
        ('Gli studenti ascoltano con attenzione le spiegazioni del professore, cercando di cogliere ogni dettaglio importante', '8'),
        ('Nella biblioteca della scuola, i ragazzi si immergono tra le pagine dei libri, alla ricerca di nuove conoscenze e avventure', '8'),
        ('Durante le presentazioni di gruppo, gli studenti si organizzano e collaborano per preparare un discorso convincente', '8'),
        ('I tifosi nello stadio si alzano in piedi, urlando e applaudendo quando la squadra segna un gol straordinario', '8'),
        ('Gli allenatori studiano strategie e schemi di gioco per dare alla loro squadra un vantaggio tattico durante le partite', '8'),
        ('I bambini nel parco giocherellano con il pallone, sognando di diventare campioni di calcio un giorno', '8'),

        ('Con il semaforo verde bisogna passare, con il giallo bisogna iniziare a fermarsi con molta attenzione e con il rosso ci si ferma', '9'),
        ('La dolce brezza estiva accarezza delicatamente il viso, mentre i fiori sbocciano in una grande esplosione di colori nel giardino fiorito del villaggio tranquillo', '9'),
        ('Estate calda, giornate serene, il mare cristallino invita a lunghe nuotate e tramonti incantevoli regalano spettacoli indimenticabili', '9'),
        ('Questa dolce aria fresca della montagna riempie i polmoni mentre i passi sul sentiero rivelano panorami mozzafiato e un senso di avventura che si fa strada nel cuore', '9'),
        ('Un sentiero tortuoso si snoda tra alte montagne, conducendomi verso una vista mozzafiato, dove il vento sussurra segreti di avventure ancora da vivere', '9'),
        ('Le squadre si affrontano con passione, il pallone vola in aria, schiacciate potenti e difese impeccabili regalano emozioni indimenticabili sulla sabbia o in campo', '9'),
        ('I computer moderni, con la loro potenza di calcolo e la connessione globale, hanno trasformato il mondo, rendendo possibile la condivisione di conoscenze senza confini', '9'),
        ('Gli occhi fedeli del cane brillano di gioia mentre corre felice nel prato, scodinzolando al suono delle risate e conquistando cuori con la sua dolcezza', '9'),
        ('La luce del sole illumina la morbida pelliccia del gatto che, con eleganza, si avvicina al mio fianco, cercando coccole e donando pura gioia', '9'),
        ('Attraverso il telefono tra le mani, esploro mondi virtuali ricchi di avventure, sfide epiche e personaggi indimenticabili, immergendomi in una sommersiva esperienza ludica senza confini', '9'),
        ('La mamma, con dolcezza infinita, accoglie nel suo abbraccio caldo, donando amore incondizionato e saggezza preziosa per guidare nella vita con affetto e coraggio', '9'),
        ('Gli studenti affollano i corridoi con zaini sulle spalle, ansiosi di imparare e crescere, mentre i professori illuminano le menti con saggezza e passione', '9'),
        ('Le fragranti spezie si mescolano nel pentolino, mentre il sugo aromatico sfrigola sulla fiamma, invitando a gustose e ricche delizie culinarie', '9'),
        ('La pizza appena sfornata, croccante e profumata, conquista il palato con il suo miscuglio di sapori come pomodoro, mozzarella filante e altri gustosi ingredienti', '9'),
        ('I fiori sbocciano nel giardino, colorando il paesaggio con petali delicati e profumi avvolgenti, regalando gioia e bellezza alla natura circostante', '9'),
        ('Nel futuro, la tecnologia avanza in modo esponenziale, trasformando le nostre vite e aprendo porte verso nuove scoperte e possibilità sorprendenti', '9'),
        ('Il lunedì inizia la settimana con energie rinnovate, mentre il venerdì si respira la grande attesa del fine settimana imminente', '9'),
        ('Con cura e precisione, pulisco ogni angolo della casa, rimuovendo polvere e sporco, riportando freschezza e ordine nell'ambiente che amo', '9'),
        ('I personaggi animati saltano fuori dallo schermo, portando sorrisi e allegria a grandi e piccini, creando un mondo magico fatto di colori e avventure senza confini', '9'),
        ('Gli elefanti, maestosi e pacifici, camminano con passo lento tra la savana, mentre il loro potente barrito risuona nella dolce aria, simbolo di forza e saggezza', '9'),

        ('Treno troppo stretto e troppo stracco stracca troppi storpi e stroppia troppo', '10'),
        ('Li vuoi quei kiwi? E se non vuoi quei kiwi che kiwi vuoi?', '10'),
        ('Guglielmo coglie ghiaia dagli scogli scagliandola oltre gli scogli tra mille gorgogli', '10'),
        ('Sa chi sa se sa chi sa che se sa non sa se sa, sol chi sa che nulla sa ne sa più di chi ne sa', '10'),
        ('Stiamo bocconi cogliendo cotoni, stiamo sedendo cotoni cogliendo', '10'),
        ('A che serve che la serva si conservi la conserva se la serva quando serve non si serve di conserva?', '10'),
        ('Quel pazzo ha rubato un pizzo prezioso con un pezzo di pizza in un pozzo', '10'),
        ('Porta aperta per chi porta, chi non porta parta pure per la porta aperta, poco importa', '10'),
        ('Tre tigri contro tre tigri', '10'),
        ('Il Papa pesa e pesta il pepe a Pisa, Pisa pesa e pesta il pepe al Papa', '10'),
        ('Sul tagliere gli agli taglia non tagliare la tovaglia la tovaglia non è aglio se la tagli fai uno sbaglio', '10'),
        ('Stanno stretti sotto i letti sette spettri a denti stretti', '10'),
        ('Chi ama chiama chi ama, chiamami tu che chi ami chiami', '10'),
        ('A che serve che la serva si conservi la conserva, se la serva quando serve non si serve di conserva?', '10'),
        ('Il cuoco cuoce in cucina e dice che la cuoca giace e tace perché sua cugina non dica che le piace cuocere in cucina col cuoco', '10'),
        ('Una zuppa e una zappa rovesciano la zuppa su di una zecca', '10'),
        ('Se il coniglio gli agli ti piglia, levagli gli agli e tagliagli gli artigli', '10'),
        ('Date del pane al cane pazzo, date del cane al pazzo cane', '10'),
        ('In un piatto poco cupo poco pepe cape', '10'),
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
