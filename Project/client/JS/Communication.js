//TMDB

const API_KEY = 'api_key=655aa5955b48a73215dd5e50081e738b';
const BASE_URL = 'https://api.themoviedb.org/3';
const API_URL = BASE_URL + '/person/popular?'+API_KEY;
const IMG_URL = 'https://image.tmdb.org/t/p/w500';

const main = document.getElementById('main');

getMovies(API_URL);

function getMovies(url) {
    lastUrl = url;
    fetch(url).then(res => res.json()).then(data => {
        console.log(data.results)
        if(data.results.length !== 0){
            showMovies(data.results);
        }else{
            main.innerHTML= `<h1 class="no-results">No Results Found</h1>`
        }

    })
}

function showMovies(data) {
    main.innerHTML = '';

    let i = 0;
    data.forEach(movie => {
        const {name, profile_path} = movie;
        const movieEl = document.createElement('div');
        movieEl.innerHTML = `
            <img className='grid-item grid-item-1' src="${IMG_URL + profile_path}" alt=''>
            <p style="color:#EFC36AFF">${name}</p>
        `


        main.appendChild(movieEl);

        /*        i++;
                if (i == 9)
                {
                    throw 'Break';
                }*/
    })
}