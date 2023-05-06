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
      `idText` CHAR(5) PRIMARY KEY,
      `text` TEXT NOT NULL,
      `level` INT NOT NULL
);";

if ($conn->query($sql) === TRUE) {
    echo "Tabella texts creata con successo\n";
} else {
    echo "Errore nella creazione della tabella texts: " . $conn->error;
}

$sql = "CREATE TABLE IF NOT EXISTS `attempts` (
      `idAttempt` CHAR(5) PRIMARY KEY,
      `username` VARCHAR(255) NOT NULL,
      `idText` CHAR(5) NOT NULL,
      `dateAttempt` DATE NOT NULL,
      `time_elapsed` DOUBLE NOT NULL,
      `passed` BOOLEAN NOT NULL,
      FOREIGN KEY(`username`) REFERENCES `users`(`username`),
      FOREIGN KEY(`idText`) REFERENCES `texts`(`idText`)
);";

if ($conn->query($sql) === TRUE) {
    echo "Tabella attempt creata con successo\n";
} else {
    echo "Errore nella creazione della tabella attempt: " . $conn->error;
}

$sql = "INSERT IGNORE INTO `users` (`username`, `password`, `name`, `surname`, `role`) VALUES
        ('MR2376', 'password1234', 'Mario', 'Rossi', 'Admin'),
        ('CF1541', '#pizza', 'Chiara', 'Ferragni', 'User')
;";

if ($conn->query($sql) === TRUE) {
  echo "Dati della tabella users inseriti con successo\n";
} else {
  echo "Errore nell'inserimento dei dati nella tabella users: " . $conn->error;
}

$sql = "INSERT IGNORE INTO `texts` (`idText`, `text`, `level`) VALUES
        ('00001', 'Ciao', '1'),
        ('00002', 'Amico', '1'),
        ('00003', 'Parola', '1'),
        ('00004', 'Cane', '1'),
        ('00005', 'Gatto', '1'),
        ('00006', 'Topolino', '1'),
        ('00007', 'Semaforo', '1'),
        ('00008', 'Macchina', '1'),
        ('00009', 'Maestra', '1'),
        ('00010', 'Mamma', '1'),
        ('00011', 'Papà', '1'),
        ('00012', 'Fratello', '1'),
        ('00013', 'Sorella', '1'),
        ('00014', 'Telefono', '1'),
        ('00015', 'Zuppa', '1'),
        ('00016', 'Musica', '1'),
        ('00017', 'Maglietta', '1'),
        ('00018', 'Orso', '1'),
        ('00019', 'Bolla', '1'),
        ('00020', 'Doccia', '1'),

        ('00021', 'Sei mio amico', '2'),
        ('00022', 'Simone parla', '2'),
        ('00023', 'Ho fame', '2'),
        ('00024', 'Mamma e papà', '2'),
        ('00025', 'Giochiamo a palla', '2'),
        ('00026', 'Buona la pizza', '2'),
        ('00027', 'Vado a scuola', '2'),
        ('00028', 'Oggi è lunedi', '2'),
        ('00029', 'Andiamo al parco', '2'),
        ('00030', 'Faccio i compiti', '2'),
        ('00031', 'Mamma cucina', '2'),
        ('00032', 'Il nonno dorme', '2'),
        ('00033', 'Sei gentile', '2'),
        ('00034', 'Guardo i cartoni', '2'),
        ('00035', 'Brava mamma', '2'),
        ('00036', 'Il cane bianco', '2'),
        ('00037', 'Bella farfalla gialla', '2'),
        ('00038', 'Tiro il dado', '2'),
        ('00039', 'Sono innamorato', '2'),
        ('00040', 'Che ore sono?', '2'),

        ('00041', 'Oggi è una bellissima giornata di sole', '3'),
        ('00042', 'La sedia di legno è molto scomoda', '3'),
        ('00043', 'Mio papà legge il giornale sul divano', '3'),
        ('00044', 'Il leone è il re della giungla, forte e coraggioso', '3'),
        ('00045', 'Il cane corre veloce nel prato verde', '3'),
        ('00046', 'Il quadro dipinto è molto colorato', '3'),
        ('00047', 'Il treno veloce passa sotto il ponte', '3'),
        ('00048', 'Il bimbo costruisce un pupazzo di neve insieme al fratello', '3'),
        ('00049', 'Il mio computer nuovo è molto potente', '3'),
        ('00050', 'Il cartone animato di Peppa Pig fa ridere', '3'),
        ('00051', 'Quel cane piccolo abbaia parecchio forte', '3'),
        ('00052', 'La luna piena brilla nel cielo notturno', '3'),
        ('00053', 'I lupi ululano alla luna', '3'),
        ('00054', 'La penna blu è la mia preferita', '3'),
        ('00055', 'Domani vado a mangiare nel ristorante di zio Cioci', '3'),
        ('00056', 'Mio cugino è caduto e si è fatto la bua', '3'),
        ('00057', 'Il mio sogno è quello di diventare calciatore', '3'),
        ('00058', 'La mia squadra è forte', '3'),
        ('00059', 'Sono finito in prima pagina', '3'),
        ('00060', 'La mamma di Francesco mi ha dato un biscotto', '3'),

        ('00061', 'In autunno le foglie degli alberi cadono e diventano rosse, gialle e arancioni', '4'),
        ('00062', 'Nel cielo notturno posso vedere tante stelline luminose e bellissime', '4'),
        ('00063', 'La montagna maestosa, con le sue cime innevate e le pendici scoscese, si staglia imponente nel paesaggio', '4'),
        ('00064', 'Il gatto nero, dalle morbide zampe, dorme pacificamente sulla sedia imbottita del soggiorno', '4'),
        ('00065', 'La farfalla colorata, con le sue ali sottili e delicati, si posa sui petali dei fiori profumati del giardino', '4'),
        ('00066', 'Il cucciolo tenero e peloso, con gli occhi ancora chiusi, dorme abbracciato alla madre calda e protettiva', '4'),
        ('00067', 'Questo uccellino dalle piume scintillanti, con il suo canto melodioso, saluta il nuovo giorno dal ramo di un albero', '4'),
        ('00068', 'Il fiore profumato, dai petali delicati e sfumature vivaci, sboccia con grazia in mezzo al prato verde', '4'),
        ('00069', 'Lo scienziato ha scoperto un nuovo pianeta dove abitano gli alieni', '4'),
        ('00070', 'Gli scoiattoli del boschetto vicino a casa sono veloci e agili', '4'),
        ('00071', 'Il castello antico, con la sua architettura imponente e le torri imponenti, evoca una bella atmosfera romantica e misteriosa', '4'),
        ('00072', 'Oggi sono uscito di casa con una sciarpetta perchè faceva molto freddo', '4'),
        ('00073', 'Il mare tempestoso, con le sue onde alte e il vento forte, mette alla prova la forza dei marinai', '4'),
        ('00074', 'La scienza ci permette di conoscere e scoprire tutto il mondo in cui viviamo', '4'),
        ('00075', 'Fra una settimana a Verona ci sarà il mio cantante preferito in Arena', '4'),
        ('00076', 'Ho fatto la verifica di scienze sul corpo umano e ho preso 10', '4'),
        ('00077', 'Questo sciroppo per la tosse ha un cattivo gusto', '4'),
        ('00078', 'Mia sorella è allergica al glutine, quindi deve mangiare il pane integrale', '4'),
        ('00079', 'La pianura estesa, con il suo paesaggio rilassante e le sue coltivazioni rigogliose, rappresenta il cuore verde del territorio', '4'),
        ('00080', 'Il fiume impetuoso, dalle acque cristalline e gelide, scorre rapido tra le rocce del canyon', '4'),

        ('00081', 'Al pozzo dei pazzi una pazza lavava le pezze. Andò un pazzo e buttò la pazza con tutte le pezze nel pozzo dei pazzi', '5'),
        ('00082', 'Li vuoi quei kiwi? E se non vuoi quei kiwi che kiwi vuoi?', '5'),
        ('00083', 'Apelle figlio d\\'Apollo fece una palla di pelle di pollo, tutti i pesci vennero a galla per vedere la palla di pelle di pollo fatta da Apelle figlio d\\'Apollo', '5'),
        ('00084', 'Trentatré trentini entrarono a Trento, tutti e trentatré di tratto in tratto trotterellando', '5'),
        ('00085', 'A quest\\'ora il questore in questura non c\\'è', '5'),
        ('00086', 'Una rara rana nera sulla rena errò una sera, una rara rana bianca sulla rena errò un po\\' stanca', '5'),
        ('00087', 'Quel pazzo ha rubato un pizzo prezioso con un pezzo di pizza in un pozzo', '5'),
        ('00088', 'Filastrocca sciogligrovigli con la lingua ti ci impigli ma poi te la sgrovigli basta che non te la pigli', '5'),
        ('00089', 'Tre tigri contro tre tigri', '5'),
        ('00090', 'Il Papa pesa e pesta il pepe a Pisa, Pisa pesa e pesta il pepe al Papa', '5'),
        ('00091', 'Caro conte chi ti canta tanto canta che t\\'incanta', '5'),
        ('00092', 'Una platessa lessa lesse la esse di Lessie su un calesse fesso', '5'),
        ('00093', 'Tito, tu m\\'hai ritinto il tetto, ma non t\\'intendi tanto di tetti ritinti', '5'),
        ('00094', 'A che serve che la serva si conservi la conserva, se la serva quando serve non si serve di conserva?', '5'),
        ('00095', 'Il cuoco cuoce in cucina e dice che la cuoca giace e tace perché sua cugina non dica che le piace cuocere in cucina col cuoco', '5'),
        ('00096', 'Sessantasei sassolini assetati e sassosi si assetarono ad Assisi', '5'),
        ('00097', 'Se il coniglio gli agli ti piglia, levagli gli agli e tagliagli gli artigli', '5'),
        ('00098', 'Sa chi sa se sa chi sa che se sa non sa se sa, sol chi sa che nulla sa ne sa più di chi ne sa', '5'),
        ('00099', 'Se l\\'arcivescovo di Costantinopoli si disarcivescoviscostantinopolizzasse, tu ti disarcivescoviscostantinopolizzeresti come si è disarcivescoviscostantinopolizzato l\\'arcivescovo di Costantinopoli?', '5'),
        ('00100','Sopra la panca la capra campa, sotto la panca la capra crepa', '5')
;";

if ($conn->query($sql) === TRUE) {
  echo "Dati della tabella texts inseriti con successo\n";
} else {
  echo "Errore nell'inserimento dei dati nella tabella texts: " . $conn->error;
}

$sql = "INSERT IGNORE INTO `attempts` (`idAttempt`, `username`, `idText`, `dateAttempt`, `time_elapsed`, `passed`) VALUES
        ('00001', 'MR2376', '00034', '2023-05-04', 1.25, 1),
        ('00002', 'CF1541', '00095', '2023-04-19', 2.56, 0),
        ('00003', 'CF1541', '00078', '2023-02-21', 0.32, 1)
;";

if ($conn->query($sql) === TRUE) {
  echo "Dati della tabella attempts inseriti con successo\n";
} else {
  echo "Errore nell'inserimento dei dati nella tabella attempts: " . $conn->error;
}