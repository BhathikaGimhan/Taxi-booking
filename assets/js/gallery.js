var galleryThumbs = new Swiper(".gallery-thumbs", {
    centeredSlides: true,
    centeredSlidesBounds: true,
    slidesPerView: 3,
    watchOverflow: true,
    watchSlidesVisibility: true,
    watchSlidesProgress: true,
    direction: 'vertical'
});


var galleryMain = new Swiper(".gallery-main", {
    watchOverflow: true,
    watchSlidesVisibility: true,
    watchSlidesProgress: true,
    preventInteractionOnTransition: true,
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev'
    },

    effect: 'fade',
    fadeEffect: {
        crossFade: true
    },

    thumbs: {
        swiper: galleryThumbs
    }
});



galleryMain.on('slideChangeTransitionStart', function() {
    galleryThumbs.slideTo(galleryMain.activeIndex);
});

galleryThumbs.on('transitionStart', function() {
    galleryMain.slideTo(galleryThumbs.activeIndex);
});



// document.addEventListener('DOMContentLoaded', function() {
//     const gallery = document.getElementById('gallery');
//     for (let i = 1; i <= 14; i++) {
//         const col = document.createElement('div');
//         col.classList.add('col-md-4', 'mb-4');

//         const card = document.createElement('div');
//         card.classList.add('card');

//         const img = document.createElement('img');
//         img.classList.add('card-img-top');
//         img.src = `assets/img/Gallery/${i}.jpg`;
//         img.alt = `Image ${i}`;

//         const cardBody = document.createElement('div');
//         cardBody.classList.add('card-body');

//         const title = document.createElement('h5');
//         title.classList.add('card-title');
//         title.textContent = `Image ${i}`;

//         cardBody.appendChild(title);
//         card.appendChild(img);
//         card.appendChild(cardBody);
//         col.appendChild(card);
//         gallery.appendChild(col);
//     }
// });