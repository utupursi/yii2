let score = 0;
let currentQuestion = 0;
let quiz = document.getElementById('quiz');
let questionEl = document.getElementById('question');
let option = document.getElementsByName('selectedAnswer');
let quiz_id = document.getElementById('2').value;
let options = document.getElementsByName('option');
let nextButton = document.getElementById('nextButton');
let resultCount = document.getElementById('result');
let Container;
let previousButton;

let data = $.ajax({
    url: `/quiz/quiz?id=${quiz_id}`,
    type: 'get',
    aysnc: false,
    data: {_csrf: yii.getCsrfToken()},
    success: function (data) {
        data = JSON.parse(data);
        console.log(data[1])
        callback(data[0]);
    }

});

function callback(data) {

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

        if (currentQuestion == 0) {
            let button = document.createElement('button');

            button.setAttribute('id', 'PreviousButton');
            button.setAttribute('class', 'btn btn-success');
            button.setAttribute('type', 'button');

            button.textContent = 'Previous';
            Container = document.getElementById('container');
            Container.insertBefore(button, nextButton);
            previousButton = document.getElementById('PreviousButton');
            previousButton.onclick = loadPreviousQuestion;
        }
        if (currentQuestion == data.length - 2) {
            nextButton.remove();
            let finish = document.createElement('button');
            finish.setAttribute('id', 'finishButton');
            finish.setAttribute('class', 'btn btn-success');
            finish.textContent = 'Finish';
            Container = document.getElementById('container');
            Container.appendChild(finish);
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
                currentQuestion: currentQuestion + 1,
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

            nextButton = document.createElement('button');
            nextButton.setAttribute('id', 'nextButton');
            nextButton.setAttribute('class', 'btn btn-success');
            nextButton.setAttribute('type', 'button');
            nextButton.textContent = 'Next';
            Container = document.getElementById('container');
            Container.appendChild(nextButton);
            nextButton.onclick = loadNextQuestion;
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
                currentQuestion: currentQuestion + 1,
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

    // $.ajax({
    //     type: "GET",
    //     url: `/quiz/quiz?id=${quiz_id}`,
    //     data: {
    //         answers: data[currentQuestion].answers,
    //     },
    //     success: function (result) {
    //         result = result != '' ? JSON.parse(result) : {};
    //         console.log(result);
    //         console.log(result[1].current_question)
    //         currentQuestion = result[1].current_question-1;
    //         loadQuestion(currentQuestion, result[0]);
    //     },
    //     error: function (result) {
    //
    //     }
    // });
    $.ajax({
        type: "POST",
        url: `/quiz/quiz?id=${quiz_id}`,
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







