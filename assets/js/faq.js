function toggleAnswer(answerId) {
  var answer = document.getElementById(answerId);
  if (answer.classList.contains('active')) {
    answer.classList.remove('active');
  } else {
    answer.classList.add('active');
  }
}
