import axios from 'axios';

const getQuestions = () => {
    return axios
        .get('/api/questions'
        .then(data => {
            
        })
        .error(err => console.log(err)));
        
}

export default getQuestions;