var defaultThreads = [
    {
        id: 1,
        title: "Среща на випуск 2015",
        author: "Силвия",
        date: Date.now(),
        content: "Срещата ще се състои на 25.07.2022г. В ресторант Панорама от 20:00ч.",
        comments: [
            {
                author: "Моника",
                date: Date.now(),
                content: "Ще присъствам."
            },
            {
                author: "Тодор",
                date: Date.now(),
                content: "Задължително ще дойда."
            }
        ]
    },
    {
        id: 2,
        title: "Почистване на кв. Студенски град",
        author: "Станислава",
        date: Date.now(),
        content: "Почистване на кв. Студенски град на 20.07.2022г.",
        comments: [
            {
                author: "Никола",
                date: Date.now(),
                content: "Там сме."
            },
            {
                author: "Ана",
                date: Date.now(),
                content: "Къде да видим подробности?"
            }
        ]
    },
    {
        id: 3,
        title: "Тържествено връчване на дипломите",
        author: "Асибе",
        date: Date.now(),
        content: "На 19.04.2022 г. (вторник) от 14.00 ч. в Аулата на Софийски университет",
        comments: [
            {
                author: "Никола",
                date: Date.now(),
                content: "Там сме."
            },
            {
                author: "Ана",
                date: Date.now(),
                content: "Къде да видим подробности?"
            }
        ]
    },  
]

var threads = defaultThreads
if (localStorage && localStorage.getItem('threads')) {
    threads = JSON.parse(localStorage.getItem('threads'));
} else {
    threads = defaultThreads;
    localStorage.setItem('threads', JSON.stringify(defaultThreads));
}



window.localStorage.clear();