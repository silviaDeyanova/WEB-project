var defaultThreads = [
    {
        id: 1,
        title: "Тема 1",
        author: "Stanislava",
        date: Date.now(),
        content: "Събиране на випуск 2015",
        comments: [
            {
                author: "Kiki",
                date: Date.now(),
                content: "Ще присъствам"
            },
            {
                author: "Тодор",
                date: Date.now(),
                content: "Там съм"
            }
        ]
    },
    {
        id: 2,
        title: "Тема 2",
        author: "Asibe",
        date: Date.now(),
        content: "Събиране на випуск 2016",
        comments: [
            {
                author: "Никола",
                date: Date.now(),
                content: "Няма да мога да дойда."
            },
            {
                author: "Ана",
                date: Date.now(),
                content: "Ще присъствам"
            }
        ]
    }
]

var threads = defaultThreads
if (localStorage && localStorage.getItem('threads')) {
    threads = JSON.parse(localStorage.getItem('threads'));
} else {
    threads = defaultThreads;
    localStorage.setItem('threads', JSON.stringify(defaultThreads));
}
//var nameAutor = document.getElementById('username');
//window.localStorage.clear();