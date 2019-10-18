class MovieDb {
    constructor(apiKey) {
        this.apiKey = apiKey;
        this.sum = 0;
        this.oldest_film = [];
    }

    searchMovies(searchKeyword) {
        return fetch('https://jsonplaceholder.typicode.com/posts');
    }

    m(movies) {

        let g = 0;

        for (let i = 0; i < movies.length; i++) {
            fetch(`https://jsonplaceholder.typicode.com/comments?postId=${movies[i].id}`)
                .then((success) => {
                    success.json().then((comments) => {
                            console.log(comments);

                            for(let i=0;i<comments.length;i++){
                                console.log(comments[i].name);
                            }
                    })
                })

        }


    }
}

const API_KEY = 'ab4b7d2f';
const moviesDb = new MovieDb(API_KEY);


moviesDb.searchMovies('Avengers')
    .then((success) => {
        success.json().then((movies)=> {
            moviesDb.m(movies);
        })

    })



function m(){

    return new Promise((resolve,reject)=>{{
        resolve('giorgi');

    }})


}


m().then((value)=>{
    console.log(value);
})
console.log(2);
