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