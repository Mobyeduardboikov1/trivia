import React from 'react';
import PropTypes from 'prop-types';

class Question extends React.Component {

    constructor(props) {
        super(props);
        this.state = {
            correctAnswer: props.answers && props.answers[0] || null,
            answered: false,
            answers: props.answers && props.answers.sort(() => Math.random() - 0.5),
        };
    }
    
    setAnswer = (value) => {
        this.setState({ answered: value })
        if (this.props.onAnswer) {
            this.props.onAnswer(value, value == this.state.correctAnswer);
        }
    }

    
    render() {
        const { question, isDisabled } = this.props;
        const { answers } = this.state;
        return (
            <div className="container">
                <h2>{question}</h2>
                {answers.map((answer, i) => (
                    <div>
                        <label for={`answer-${i}`}>{answer}</label>
                        <input 
                            id={`answer-${i}`}
                            name="answer"
                            onClick={e => this.setAnswer(e.target.value)} 
                            type="radio" 
                            value={answer} 
                            checked={(isDisabled && answer == this.state.correctAnswer) || (!isDisabled && this.state.answered && this.state.answered == answer)}
                            disabled={isDisabled}
                            className={"w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"}
                        />
                    </div>
                    
                ))}
            </div>
        );
    }
}

Question.propTypes = {
    question: PropTypes.string.isRequired,
    answers: PropTypes.array.isRequired,
    onAnswer: PropTypes.func,
    isDisabled: PropTypes.bool,
}

Question.defaultProps = {
    onAnswer: () => {},
    isDisabled: false,
}

export default Question;
