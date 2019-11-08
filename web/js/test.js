let currentQuestion = 0;
let score = 0;
let quiz = document.getElementById('quiz');
let container = document.getElementsByClassName('modal-body');
let questionEl = document.getElementById('question');
let option = document.getElementsByName('selectedAnswer');
let quiz_id = document.getElementById('2').value;
let options = document.getElementsByName('option');
let nextButton = document.getElementById('nextButton');
let previousButton = document.getElementById('PreviousButton');
let resultCount = document.getElementById('result');


console.log(quiz_id)

let myResponse = [];
let data = $.ajax({
    url: `/quiz/quiz?id=${quiz_id}`,
    type: 'get',
    aysnc: false,
    data: {_csrf: yii.getCsrfToken()},
    success: function (data) {
        data = JSON.parse(data);
        callback(data);
    }

});

function callback(data) {
    let totQuestions = data.length;

    previousButton.onclick = loadPreviousQuestion;
    nextButton.onclick = loadNextQuestion;

    function loadQuestion(questionIndex, result) {
        let question = data[questionIndex];
        questionEl.textContent = (questionIndex + 1) + '. ' + question.name;
        for (let g = 0; g < question.answers.length; g++) {
            let label = document.createElement('label');
            let labelChild = document.createElement('label');
            let labelChild1 = document.createElement('label');
            let input = document.createElement('input');
            let span = document.createElement('span');

            label.setAttribute('id', 'con');
            label.setAttribute('class', 'btn-lg btn-primary btn-block');

            labelChild1.setAttribute('class', 'option');

            input.setAttribute("type", "radio");
            input.setAttribute("name", 'option');
            input.setAttribute('class', 'classOfInput');
            input.setAttribute('id', `opt${g + 1}`)
            input.setAttribute('value', question.answers[g].name);

            span.setAttribute('id', `opt${g + 1}`)
            questionEl.setAttribute('value', question.id)

            quiz.appendChild(label);
            label.appendChild(labelChild);
            labelChild.appendChild(labelChild1);
            labelChild1.appendChild(input);
            labelChild1.appendChild(span);

            if (result) {
                if (result.selected_answer === question.answers[g].name) {
                    let selected = document.getElementById(`opt${g + 1}`);
                    selected.checked = true;
                }
            }
            span.textContent = question.answers[g].name

        }

    }

    function loadNextQuestion() {
        let selectedOption;
        if (document.querySelector('input[name="option"]:checked') != null) {
            selectedOption = document.querySelector('input[name="option"]:checked').value;
        } else {
            selectedOption = '';
        }
        let q = data[currentQuestion];
        for (let g = 0; g < q.answers.length; g++) {
            let label = document.getElementById('con');
            label.remove();
        }

        $.ajax({
            type: "POST",
            url: '/quiz/nextselected',
            data: {
                selected: selectedOption,
                question: data[currentQuestion].id,
                nextQuestion: data[currentQuestion + 1].id,
                nextAnswers: data[currentQuestion + 1].answers,
                quizId: quiz_id,
            },
            success: function (result) {
                currentQuestion++;
                result = result != '' ? JSON.parse(result) : {};
                loadQuestion(currentQuestion, result)
            },
            error: function (result) {

            }
        });
    }

    function loadPreviousQuestion() {
        let selectedOption;

        if (document.querySelector('input[name="option"]:checked') != null) {
            selectedOption = document.querySelector('input[name="option"]:checked').value;
        } else {
            selectedOption = '';
        }

        let q = data[currentQuestion];
        for (let g = 0; g < q.answers.length; g++) {
            let label = document.getElementById('con');
            label.remove();
        }
        $.ajax({
            type: "POST",
            url: '/quiz/previousselected',
            data: {
                selected: selectedOption,
                question: data[currentQuestion].id,
                previousQuestion: data[currentQuestion - 1].id,
                previousAnswers: data[currentQuestion - 1].answers,
                quizId: quiz_id,
            },
            success: function (result) {
                currentQuestion--;
                result = result != '' ? JSON.parse(result) : {};
                loadQuestion(currentQuestion, result)
            },
            error: function (result) {
                alert('cudia');
            }
        });


    }


    loadQuestion(currentQuestion);
}






