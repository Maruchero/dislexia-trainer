// Elements
// recordButton
// chat
// text

// Initial checks
if (
  window.hasOwnProperty("SpeechRecognition") ||
  window.hasOwnProperty("webkitSpeechRecognition")
) {
  navigator.mediaDevices
    .getUserMedia({ audio: true })
    .then(function (stream) {
      _speech_recog = true;
    })
    .catch(function (err) {
      alert("Please enable access and attach a microphone.");
    });
} else {
  alert("Speech recognition not supported.");
}

// Init recognition
const SpeechRecognition =
  window.SpeechRecognition || window.webkitSpeechRecognition;
const recognition = new SpeechRecognition();
recognition.continuous = true;
recognition.interimResults = true;
recognition.lang = "it-IT";
let lastParagraph = 0;
let lastWord = "";

// Recod button events
let recording = false;
recordButton.addEventListener("click", () => {
  if (recording) {
    recognition.onend = recognition.stop;
    recognition.stop();
    console.log("Recognition stopped");
    recording = false;
    recordButton.classList.remove("active");
  } else {
    lastParagraph = 0;
    recognition.onend = recognition.start;
    recognition.start();
    console.log("Recognition started");
    recording = true;
    recordButton.classList.add("active");
  }
});
recordButton.click();

/*********************************************************
 * Words highlighting
 */
const sentences = {
  1: [
    "Il gatto miagola",
    "La casa è grande",
    "Il cane abbaia",
    "La macchina è rossa",
    "Il cielo è azzurro",
  ],
  2: [
    "La mia amica abita in una casa gialla",
    "Il mio cane ama giocare con la palla",
    "La mia macchina nuova è molto veloce",
    "Il cielo di notte è pieno di stelle",
    "La mia città preferita è New York",
  ],
  3: [
    "La mia famiglia e io amiamo viaggiare in Europa",
    "Il mio sogno è di visitare il Giappone",
    "Mi piace leggere libri di fantascienza",
    "Mi piace ascoltare la musica classica",
    "Mi piace guardare film d'azione",
  ],
  4: [
    "L'arte moderna mi affascina molto",
    "Mi piace cucinare piatti esotici",
    "Mi piace fare lunghe passeggiate nel parco",
    "Mi piace andare in bicicletta nei fine settimana",
  ],
  5: [
    "Mi piace imparare nuove lingue straniere",
    "Mi piace fare volontariato per le associazioni umanitarie",
    "Mi piace fare escursioni in montagna durante l'estate",
  ],
};
let level = 1;

const generatedWords = [];
function randomSentence() {
  const randomSentence =
    sentences[level][Math.floor(Math.random() * sentences[level].length)];
  const words = randomSentence.split(" ");
  for (let word of words) {
    generatedWords.push(word);
    const span = document.createElement("span");
    span.innerHTML = word;
    span.classList.add("word");
    text.appendChild(span);
  }
  text.style.translate = 0;
}
randomSentence();

let wordTimer = new Date();
let register = [];
function checkWords(string) {
  // console.log(string, "==", generatedWords[0].toLowerCase(), "?", string == generatedWords[0].toLowerCase());
  if (generatedWords == 0) return false;
  if (string != generatedWords[0].toLowerCase()) return false;

  // Shift
  generatedWords.shift();
  const span = text.querySelector(".word:not(.pronunced)");
  span.classList.add("pronunced");

  // End of sentence
  if (generatedWords.length == 0) {
    now = new Date();
    let timeElapsed = now - wordTimer;
    register.push(timeElapsed);
    
    result.style.display = "block";
    time.innerHTML = timeElapsed / 1000 + "s"
  }
  
  return true;
}

let validationIndex = 0;
recognition.addEventListener("result", (event) => {
  console.log(event);
  // New prompt
  const isNewPrompt = event.results.length > lastParagraph;
  if (isNewPrompt) {
    // console.log("New prompt");
    lastParagraph++;
    validationIndex = 0;
  }

  // Extraction
  const result = event.results[lastParagraph - 1][0].transcript;
  const pronunced = result
    .toLowerCase()
    .replace(/[.,?!]/g, "")
    .split(" ");
  console.log(pronunced);

  if (pronunced[validationIndex] != lastWord) {
    validationIndex--;
  }

  // Validation
  for (;validationIndex < pronunced.length; validationIndex++) {
    const word = pronunced[validationIndex];
    checkWords(word);
    lastWord = word;
  }
});

function nextSentence() {
  advanceLevel();

  text.innerHTML = "";
  randomSentence();
  wordTimer = new Date();
  result.style.display = "none";
}

/********************************************************************************
 * Level handling
 */
function setLevel(p_level) {
  level = p_level;
  titleLevel.innerHTML = p_level;
  register = [];
}

const levelAverages = {
  1: 3500,
  2: 5000,
  3: 10000,
  4: 20000,
  5: 20000,
}
const averageCount = 5;
function advanceLevel() {
  if (register.length < averageCount) return;
  
  // Get the avg
  let avg = 0;
  for (let i = 0; i < averageCount; i++) {
    avg += register[register.length - averageCount + i];
  }
  avg /= averageCount;

  // Next level
  if (avg < levelAverages[level]) {
    setLevel(level + 1);
  }
}

async function ciao() {
  const words = await get_words(1);
  console.log(words);
}
ciao();
