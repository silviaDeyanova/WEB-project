var defaultThreads = [
    {
        id: 1,
        title: "Тема 1",
        author: "Stanislava",
        date: Date.now(),
        content: "Събиране на випуск 2015",
        comments: [
            {
                author: 
                fetch("post.php", {
                    method: "POST",
                    headers: {
                      "Content-Type": "application/json",
                    },
                    body: JSON.stringify(data),
                  })
                ,
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
encodeURI();

var threads = defaultThreads
if (localStorage && localStorage.getItem('threads')) {
    threads = JSON.parse(localStorage.getItem('threads'));
} else {
    threads = defaultThreads;
    localStorage.setItem('threads', JSON.stringify(defaultThreads));
}
//window.localStorage.clear();