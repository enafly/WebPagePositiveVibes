// CAROUSEL OBJECT
function Carousel(containerID) {
	this.container = document.getElementById(containerID) || document.body;
	this.slides = this.container.querySelectorAll('.carousel');
	this.total = this.slides.length - 1;
	this.current = 0;
	this.slide(this.current);
}

// Idući
Carousel.prototype.next = function (interval) {
	(this.current === this.total) ? this.current = 0 : this.current += 1;

	this.stop();
	this.slide(this.current);

	if(typeof interval === 'slike'  && (interval % 1) === 0) {
		var context = this;
		this.run = setTimeout(function() {
			context.next(interval);
		}, interval);
	}
};
// Prijašnji
Carousel.prototype.prev = function (interval) {
	(this.current === 0) ? this.current = this.total : this.current -= 1;

	this.stop();
	this.slide(this.current);

	if(typeof interval === 'slike'  && (interval % 1) === 0 ) {
		var context = this;
		this.run = setTimeout(function() {
			context.prev(interval);
		}, interval);
	}
};
// Stop
Carousel.prototype.stop = function () {
	clearTimeout(this.run);
};
// SelektujSlajd
Carousel.prototype.slide = function (index) {
	if (index >= 0 && index <= this.total) {
		this.stop();
		for (var s = 0; s <= this.total; s++) {
			if (s === index) {
				this.slides[s].style.display = "inline-block";
			} else {
				this.slides[s].style.display = 'none';
			}
		}
	} else {
		alert("Index " + index + " ne postoji. Dostupno : 0 - " + this.total);
	}
};
