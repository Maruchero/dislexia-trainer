window.onload = async function () {
  // Get attempts
  let attempts = await get_attempts(username);
  let level = 1;
  if (attempts) {
    for (let attempt of attempts)
      if (attempt.level > level) level = parseInt(attempt.level);
  }

  // Level title
  levelTitle.innerHTML = `Livello ${level}`;
  
  // Passed array
  let attempsOfThisLevel = attempts.filter((attemp) => attemp.level == level);
  let values = []
  let sum = 0;
  for (let attempt of attempsOfThisLevel) {
    sum += parseInt(attempt.passed) ? 1 : - 1;
    values.push({x: attempt.dateAttempt, y: sum});
  }

  // Chart
  const ctx = document.getElementById("progressChart");

  new Chart(ctx, {
    type: "line",
    data: {
      datasets: [
        {
          data: values,
          tension: 0,
          label: "Progressi",
          borderColor: "orange",
          backgroundColor: "orange",
        },
      ],
    },
    options: {
      scales: {
        x: {
          type: "time",
          time: {
            unit: "hour",
          },
        },
      },
      elements: {
        point: {
          radius: 3,
        },
      },
    },
  });
};
