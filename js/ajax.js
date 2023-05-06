async function get_texts_by_level(level) {
  const formData = new FormData();
  formData.append("mode", "get_by_level");
  formData.append("level", level);
  return await (
      await fetch(`backend/controller/ControllerTexts.php`, {
          method: "POST",
          body: formData,
      })
  ).json();
}

async function get_attempts(username) {
  const formData = new FormData();
  formData.append("mode", "get_attempts");
  formData.append("username", username);
  return await (
      await fetch(`backend/controller/ControllerAttempts.php`, {
          method: "POST",
          body: formData,
      })
  ).json();
}

async function create_attempt(username, idText, dateAttempt, time_elapsed, passed) {
  const formData = new FormData();
  formData.append("mode", "create_attempt");
  formData.append("username", username);
  formData.append("idText", idText);
  formData.append("dateAttempt", dateAttempt);
  formData.append("time_elapsed", time_elapsed);
  formData.append("passed", passed);
  return await (
      await fetch(`backend/controller/ControllerAttempts.php`, {
          method: "POST",
          body: formData,
      })
  ).text();
} 