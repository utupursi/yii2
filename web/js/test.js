let score = 0;
let quiz = document.getElementById('quiz');
let questionEl = document.getElementById('question');
let option = document.getElementsByName('selectedAnswer');
let quiz_id = document.getElementById('2').value;
let options = document.getElementsByName('option');
let nextButton = document.getElementById('nextButton');
let Container;
let previousButton;
let finishButton;

let data = $.ajax({
    url: `/quiz/quiz?id=${quiz_id}`,
    type: 'get',
    aysnc: false,
    data: {_csrf: yii.getCsrfToken()},
    success: function (data) {
        let currentQuestion;
        data = JSON.parse(data);
        if (data[1] != null) {
            let current = parseInt(data[1].current_question);
            if (data[1].button === 'previousButton') {
                currentQuestion = current - 1;
            }
            if (data[1].button === 'nextButton') {
                currentQuestion = current + 1;
            }
            if (data[1].button === 'finishButton') {
                currentQuestion = current
            }
        } else {
            currentQuestion = 0;
        }
        callback(data[0], currentQuestion);
    }

});

function callback(data, currentQuestion) {

    nextButton.onclick = loadNextQuestion;

    function PreviousButtonCreator() {
        let preButton = document.createElement('button');

        preButton.setAttribute('id', 'PreviousButton');
        preButton.setAttribute('class', 'btn btn-success');
        preButton.setAttribute('type', 'button');
        preButton.textContent = 'Previous';
        Container = document.getElementById('container');
        Container.insertBefore(preButton, nextButton);
        previousButton = document.getElementById('PreviousButton');
        previousButton.onclick = loadPreviousQuestion;
    }

    function NextButtonCreator() {
        nextButton = document.createElement('button');
        nextButton.setAttribute('id', 'nextButton');
        nextButton.setAttribute('class', 'btn btn-success');
        nextButton.setAttribute('type', 'button');
        nextButton.textContent = 'Next';
        Container = document.getElementById('container');
        Container.appendChild(nextButton);
        nextButton.onclick = loadNextQuestion;
    }

    function FinishButtonCreator() {
        let finish = document.createElement('button');
        finish.setAttribute('id', 'finishButton');
        finish.setAttribute('class', 'btn btn-success');
        finish.setAttribute('type', 'button');
        finish.textContent = 'Finish';
        Container = document.getElementById('container');
        Container.appendChild(finish);
        finishButton = document.getElementById('finishButton');
        finishButton.onclick = sentData;
    }

    function sentData() {
        let selectedOption;
        if (document.querySelector('input[name="option"]:checked') != null) {
            selectedOption = document.querySelector('input[name="option"]:checked').value;
        } else {
            selectedOption = '';
        }

        $.ajax({
            type: "POST",
            url: '/quiz/finish',
            data: {
                selected: selectedOption,
                question: data[currentQuestion].id,
                quizId: quiz_id,
                currentQuestion: currentQuestion,
                finishButton: 'finishButton'
            },
            success: function (result) {
                result = result != '' ? JSON.parse(result) : {};
                if (result == 'You should answer to all questions') {
                    let div = document.createElement('div');
                    div.setAttribute('id', 'div');
                    div.setAttribute('style', 'color:red');
                    let con = document.getElementById('c');
                    div.textContent = 'You should answer to all questions';
                    con.appendChild(div);
                }
            },
            error: function (result) {

            }
        });
    }

    function loadQuestion(questionIndex, result) {
        let preButton = document.getElementById('PreviousButton');
        if (preButton === null && currentQuestion > 0) {
            PreviousButtonCreator();
        }
        let finButton = document.getElementById('finishButton');
        if (finButton === null && currentQuestion == data.length - 1) {
            nextButton.remove();
            FinishButtonCreator();
        }
        let remove = document.getElementById('div');
        if (remove != null) {
            remove.remove();
        }

        let question = data[questionIndex];
        questionEl.textContent = (questionIndex + 1) + '. ' + question.name;
        let label = document.getElementById('con');
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

        if (currentQuestion == 0) {
            PreviousButtonCreator();
        }
        if (currentQuestion == data.length - 2) {
            nextButton.remove();
            FinishButtonCreator();
        }
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
                currentQuestion: currentQuestion,
                nextButton: 'nextButton'
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
        if (currentQuestion == 1) {
            previousButton.remove();
        }
        if (currentQuestion == data.length - 1) {
            let finishButton = document.getElementById('finishButton');
            finishButton.remove();
            NextButtonCreator();
        }
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
                currentQuestion: currentQuestion,
                previousButton: 'previousButton'
            },
            success: function (result) {
                currentQuestion--;
                result = result != '' ? JSON.parse(result) : {};
                loadQuestion(currentQuestion, result)
            },
            error: function (result) {

            }
        });


    }

    $.ajax({
        type: "POST",
        url: `/quiz/quiz?id=${quiz_id}`,
        aync: false,
        data: {
            answers: data[currentQuestion].answers,
        },
        success: function (result) {
            result = result != '' ? JSON.parse(result) : {};
            console.log(result);
            loadQuestion(currentQuestion, result);
        },
        error: function (result) {

        }
    });


}







