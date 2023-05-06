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

/*********************************************************
 * Texts and highlighting
 */
let level = 1;
let texts = [];
let register = [];
let ready = false;

async function get_texts() {
  texts = await get_texts_by_level(level);
  console.log("texts:", texts);
}
async function get_level() {
  let attempts = await get_attempts(username);
  console.log("attemps:", attempts);
  if (attempts) {
    for (let attempt of attempts)
      if (attempt.level > level) level = attempt.level;
  }
  console.log("level:", level);

  register = attempts
    .filter((attemp) => attemp.level == level)
    .map((attempt) => Number.parseFloat(attempt.time_elapsed));
}
// First fetch of levels and texts
get_level().then(() => {
  get_texts().then(() => {
    ready = true;
  });
});

// Pick random text
let timeExpected;
let textId;
let attempTime;
const generatedWords = [];
function randomSentence() {
  let chosen = texts[Math.floor(Math.random() * texts.length)];
  textId = chosen.idText;
  const randomText = chosen.text;
  const words = randomText.split(" ");
  timeExpected = words.length * 700;
  for (let word of words) {
    generatedWords.push(word);
    const span = document.createElement("span");
    span.innerHTML = word;
    span.classList.add("word");
    text.appendChild(span);
  }
  text.style.translate = 0;
  attempTime = new Date();
}

/********************************************************************************************
 * Word validation
 */
let wordTimer = new Date();
function checkWords(string) {
  // console.log(string, "==", generatedWords[0].toLowerCase(), "?", string == generatedWords[0].toLowerCase());
  if (generatedWords == 0) return false;
  if (string != generatedWords[0].toLowerCase()) return false;

  // Shift and highlight
  generatedWords.shift();
  const span = text.querySelector(".word:not(.pronunced)");
  span.classList.add("pronunced");

  // End of sentence
  if (generatedWords.length == 0) {
    let now = new Date();
    let timeElapsed = now - wordTimer - 1;
    register.push(timeElapsed);

    result.style.display = "flex";
    time.innerHTML = timeElapsed / 1000 + "s";

    // Push attemp
    let passed = timeElapsed < timeExpected;
    let formattedDate = attempTime
      .toISOString()
      .replace(/T/, " ")
      .replace(/\..+/, "");
    create_attempt(username, textId, formattedDate, timeElapsed / 1000, passed).then((r) => {
      console.log(r);
    })
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
  for (; validationIndex < pronunced.length; validationIndex++) {
    const word = pronunced[validationIndex];
    checkWords(word);
    lastWord = word;
  }
});

/********************************************************************************
 * Level handling
 */
function setLevel(p_level) {
  level = p_level;
  titleLevel.innerHTML = p_level;
  register = [];
}

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

function nextSentence() {
  if (!ready) return;
  if (!recording) recordButton.click();

  // advanceLevel();

  nextSentenceButton.innerHTML = "Prossimo";
  text.innerHTML = "";
  randomSentence();
  wordTimer = new Date();
  result.style.display = "none";
}
