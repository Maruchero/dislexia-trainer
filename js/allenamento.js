// Elements
// recordButton
// chat
// text

const TEXT_RECOGNITION_TIME = 1800;
const WORD_PRONUNCE_TIME = 600;

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
var level = 1;
var texts = [];
var passedArray = [];
var ready = false;

async function get_texts() {
  texts = await get_texts_by_level(level);
  console.log("texts:", texts);
}
async function get_level() {
  let attempts = await get_attempts(username);
  console.log("attemps:", attempts);
  if (attempts) {
    for (let attempt of attempts)
      if (attempt.level > level) level = parseInt(attempt.level);
  }
  setLevel(level);
  console.log("level:", level);

  passedArray = attempts
    .filter((attemp) => attemp.level == level)
    .map((attempt) => Number.parseFloat(attempt.passed));
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
var pronunced = false;
function randomSentence() {
  pronunced = false;
  let chosen = texts[Math.floor(Math.random() * texts.length)];
  textId = chosen.idText;
  const randomText = chosen.text;
  const words = randomText.split(" ");
  timeExpected = words.length * WORD_PRONUNCE_TIME;
  for (let word of words) {
    generatedWords.push(word);
    const span = document.createElement("span");
    span.innerHTML = word;
    span.classList.add("word");
    text.appendChild(span);
  }
  attempTime = new Date();
}

/********************************************************************************************
 * Word validation
 */
let wordTimer = new Date();
function checkWords(word) {
  // console.log(string, "==", generatedWords[0].toLowerCase(), "?", string == generatedWords[0].toLowerCase());
  if (generatedWords == 0) return false;
  if (word != generatedWords[0].replace(/[.,?!]/g, "").toLowerCase()) return false;

  // Shift and highlight
  generatedWords.shift();
  const last = text.querySelector(".word.last");
  if (last) last.classList.remove("last");
  const span = text.querySelector(".word:not(.pronunced)");
  span.classList.add("pronunced");
  span.classList.add("last");

  // End of sentence
  if (generatedWords.length == 0) {
    pronunced = true;
    let now = new Date();
    let timeElapsed = now - wordTimer - TEXT_RECOGNITION_TIME;
    if (timeElapsed < 0) timeElapsed = 0;
    let passed = timeElapsed < timeExpected;
    let passedInt = passed ? 1 : 0;
    passedArray.push(passedInt);

    result.style.display = "flex";
    time.innerHTML = timeElapsed / 1000 + "s";

    // Push attemp
    let formattedDate = attempTime
      .toISOString()
      .replace(/T/, " ")
      .replace(/\..+/, "");
    create_attempt(
      username,
      textId,
      formattedDate,
      timeElapsed / 1000,
      passed
    ).then((r) => {
      console.log(r);
    });
  }

  return true;
}
let validationIndex = 0;
recognition.addEventListener("result", (event) => {
  // New prompt
  const isNewPrompt = event.results.length > lastParagraph;
  if (isNewPrompt) {
    // console.log("New prompt");
    lastParagraph++;
    validationIndex = 0;
  }

  // Extraction
  const result = event.results[event.resultIndex][0].transcript;
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
  passedArray = [];
}

const attemptsToPass = 3;
const successfulAttemptsToPass = 2;
async function advanceLevel() {
  if (passedArray.length < attemptsToPass) return;

  // Check if it was reached the minimun number of passed attempts
  let passedCount = 0;
  for (let i = 0; i < attemptsToPass; i++) {
    if (passedArray[passedArray.length - i - 1] == 1) passedCount++;
  }

  if (passedCount > successfulAttemptsToPass && level < 5) {
    console.log("Salita di livello");
    setLevel(level + 1);
    await get_texts();
  }
  return true;
}
// TODO also use advanceLevel at the beginning

function nextSentence() {
  if (!ready) return;
  if (!recording) recordButton.click();

  advanceLevel().then(() => {
    // Next sentence
    nextSentenceButton.innerHTML = "Prossimo";
    text.innerHTML = "";
    randomSentence();
    wordTimer = new Date();
    result.style.display = "none";
  });
}

function resetSentence() {
  if (pronunced) return;

  pronunced = false;
  while (generatedWords.length > 0) {
    generatedWords.pop();
  }
  text.innerHTML = "";
  
  let chosen = texts.filter(text => text.idText == textId)[0];
  const randomText = chosen.text;
  const words = randomText.split(" ");
  timeExpected = words.length * WORD_PRONUNCE_TIME;
  for (let word of words) {
    generatedWords.push(word);
    const span = document.createElement("span");
    span.innerHTML = word;
    span.classList.add("word");
    text.appendChild(span);
  }
  attempTime = new Date();
  wordTimer = new Date();
}
