

class MovieDb {
    constructor(apiKey) {
        this.apiKey = apiKey;
        this.sum = 0;
        this.oldest_film=[];
    }

    searchMovies(searchKeyword) {
        return fetch(`http://www.omdbapi.com/?s=${searchKeyword}&apikey=${this.apiKey}`).then();
    }

    m(movies) {
        console.log(movies);
        let g=0;
        for (let i=0;i<movies.length;i++) {
            fetch(`http://www.omdbapi.com/?i=${movies[i].imdbID}&apikey=${this.apiKey}`)
                .then((success) => {
                    success.json().then(({BoxOffice: BoxOffice, Title: title,Year:year}) => {
                        if (BoxOffice != undefined && BoxOffice != 'N/A') {
                            BoxOffice = BoxOffice.replace('$', '');
                            BoxOffice = BoxOffice.replace(/,/g, '');
                            BoxOffice = parseInt(BoxOffice);
                            this.sum += BoxOffice;

                        }
                        year=parseInt(year);
                        this.oldest_film[g]=year;
                         g++;
                        if (i == movies.length - 1){
                            console.log(`Oldest film is:${Math.min(...this.oldest_film)}`);
                            console.log(`Average of boxoffice is:${this.sum/movies.length-1}`);
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
        success.json().then(({Search: movies}) => {
            moviesDb.m(movies);

        })

    })


var myset=new Set();
myset.add(1);
myset.add(2);

for(let item of myset){
    console.log(item);
}

var map=new Map();
map.set('id','1');
map.set(24,12);
console.log(map.get(24));
for(var[key,value]of map){
    console.log(value);
}

var obj={
    id:54,
    name:'Giorgi'
}

var{id:fa,name:nam}=obj;
console.log(fa,);