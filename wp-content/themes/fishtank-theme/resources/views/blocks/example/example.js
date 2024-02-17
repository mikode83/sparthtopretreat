import Swiper, { Navigation, Pagination } from 'swiper';
import 'swiper/css';

// window load event listener allows for JS to run in the CMS editor.
window.addEventListener('load', (e) => {
	const exampleSwipers = document.querySelectorAll('.example-swiper');

	exampleSwipers.forEach((exampleSwiper, index) => {
		let slider = new Swiper(exampleSwiper, {
			modules: [Navigation, Pagination],
			speed: 400,
			spaceBetween: 30,
			slidesPerView: 2,
			navigation: {
				nextEl: exampleSwiper.querySelector('.swiper-button-next'),
				prevEl: exampleSwiper.querySelector('.swiper-button-prev'),
			},
			pagination: {
				el: exampleSwiper.querySelector('.swiper-pagination'),
				clickable: true,
			},
		});
	});
});
