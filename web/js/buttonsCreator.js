export function PreviousButtonCreator() {
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

export function NextButtonCreator() {
    nextButton = document.createElement('button');
    nextButton.setAttribute('id', 'nextButton');
    nextButton.setAttribute('class', 'btn btn-success');
    nextButton.setAttribute('type', 'button');
    nextButton.textContent = 'Next';
    Container = document.getElementById('container');
    Container.appendChild(nextButton);
    nextButton.onclick = loadNextQuestion;
}

export function FinishButtonCreator() {
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
