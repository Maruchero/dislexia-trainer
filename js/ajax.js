async function get_words(level) {
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