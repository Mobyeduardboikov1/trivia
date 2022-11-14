import React from 'react';
import ReactDOM from 'react-dom';
import Question from './Question';


class Trivia extends React.Component {

    constructor(props) {
        super(props);
        this.state = {
            questions: [],
            currentIndex: null,
            gameFinished: false,
        };
    }

    componentDidMount() {
        axios.get('/api/questions')
        .then(res => {
            console.log('data', res);
            const questions = res.data;
            this.setState({ questions, currentIndex: questions.length ? 0 : null  });
        })
        .catch(error => console.log('Error', error));
    }

    checkAnswer = (answer, isCorrect) => {
        const questions = [...this.state.questions];

        questions[this.state.currentIndex].answered = answer;
        questions[this.state.currentIndex].isCorrect = isCorrect;
       
        this.setState({ questions });
    }

    nextQuestion = () => {
        const currentQuestion  = this.state.questions[this.state.currentIndex];
       
        // Stop if the answer is incorrect or the last question is answered
        let gameFinished = false;
        let nextIndex = this.state.currentIndex + 1;
        if (currentQuestion.hasOwnProperty('isCorrect') && !currentQuestion.isCorrect || this.state.currentIndex + 1 === this.state.questions.length) {
            gameFinished = true;
            nextIndex = this.state.currentIndex;
        }

        const currentIndex = this.state.currentIndex;
        this.setState({ currentIndex: nextIndex, gameFinished });
    }

    render() {
        const { questions, currentIndex, gameFinished } = this.state;
        console.log('questions', questions, currentIndex);
        let question = questions.length && questions[currentIndex] ? questions[currentIndex] : null;
        let totalCorrect = null;
        let isDisabled = false;

        // Find the last correct question
        if (gameFinished) {
            question = questions.findLast(q => q.isCorrect === false);
            totalCorrect = questions.reduce((acc, el) => acc + Number(el.isCorrect === true), 0);
            isDisabled = true;
        }
        return (
            <div className="bg-gray-100 align-center full-width">
                {gameFinished && (
                    <div>
                        <h2 className="font-bold">Game over</h2>
                        <p>You scored {totalCorrect} out of {questions.length}</p>
                    </div>
                )}
                {currentIndex !== null && currentIndex !== questions.length && `Question # ${currentIndex + 1}`}
                {question && <Question 
                    key={`question-${currentIndex}`}
                    question={question.question}
                    answers={question.answers}
                    onAnswer={this.checkAnswer}
                    isDisabled={isDisabled}
                />}
                {question && question.hasOwnProperty('isCorrect') && !gameFinished && <button className="bg-blue-500 text-white border-2 w-full p-4 roudned-lg" onClick={this.nextQuestion}>Next</button>}
            </div>
        );
    }
}

export default Trivia;
if (document.getElementById('root')) {
    ReactDOM.render(<Trivia />, document.getElementById('root'));
}
