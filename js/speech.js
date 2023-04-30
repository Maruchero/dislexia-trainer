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
// recognition.lang = "en-UK";
recognition.lang = "it-IT";

let lastParagraph = 0;
let p;
recognition.addEventListener("result", (event) => {
  if (event.results.length > lastParagraph) {
    p = document.createElement("p");
    chat.appendChild(p);
    lastParagraph++;
  }
  const result = event.results[lastParagraph - 1][0];
  p.innerHTML = result.transcript;
});

// Recod button events
let recording = false;
recordButton.addEventListener("click", () => {
  if (recording) {
    recognition.stop();
    console.log("Recognition stopped");
    recording = false;
    recordButton.classList.remove("active");
  } else {
    lastParagraph = 0;
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
const words = {
  1: [
    "ciao",
    "come",
    "letto",
    "gatto",
    "cane",
    "libro",
    "vasca",
    "penna",
    "casa",
    "salto",
    "nave",
  ],
  2: [
    "leggi",
    "pecora",
    "lettura",
    "riccio",
    "sereno",
    "giostra",
    "altalena",
    "numero",
    "cavallo",
  ],
  3: [
    "matematica",
    "ingegneria",
    "traumatico",
    "incredibile",
    "sistema",
    "nitrato",
    "irrilevante",
    "porcospino",
    "traduttore",
    "astratto",
    "empirico",
  ],
  4: ["ineffabile", "irraggiungibile", "traslucente"],
  5: ["contemporaneamente"],
};
let level = 1;

const generatedWords = [];
function generateWords(count) {
  for (let i = 0; i < count; i++) {
    const word = words[level][Math.floor(Math.random() * words[level].length)];
    generatedWords.push(word);
    const span = document.createElement("span");
    span.innerHTML = word;
    span.classList.add("word");
    text.appendChild(span);
  }
}
generateWords(20);

function checkWords(string) {
  let pronunced = string.split(" ");
  pronunced = pronunced.map((word) =>
    word.toLowerCase().replace(/[.,?!]/g, "")
  );
  console.log(pronunced, generateWords[0]);
  if (pronunced.includes(generatedWords[0])) {
    console.log(true);

    // Shift
    generatedWords.shift();
    // text.removeChild(text.firstChild);
    text.querySelector(".word:not(.pronunced)").classList.add("pronunced");

    // Regenerate
    generateWords(1);
  } else {
    console.log(false);
  }
}

recognition.addEventListener("result", (event) => {
  const result = event.results[lastParagraph - 1][0].transcript;
  checkWords(result);
});
