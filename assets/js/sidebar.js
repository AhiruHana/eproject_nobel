
var sitemap = document.querySelector('.sitemap');
var menuPosition = document.getElementById('menu').offsetHeight;
var current_url = window.location.href;

window.addEventListener('scroll', () => {
  if (current_url.includes("laureateBiography")) {
    var bioRect = document.querySelector('.bio').getBoundingClientRect();
    var sitemapRect = sitemap.getBoundingClientRect();
    sitemap.style.height = screen.height - menuPosition + 'px';

    if (sitemapRect.height < bioRect.height) {
      if (sitemapRect.top < 0) {
        sitemap.style.top = menuPosition + 'px';
      } else {
        sitemap.style.top = menuPosition + 'px';
      }
    }
  }
});


window.onscroll = function () { stickyMenu() };
var menu, sticky;
menu = document.getElementById('menu');
sticky = menu.offsetTop;

function stickyMenu() {
  if (window.pageYOffset >= sticky) {
    menu.classList.add("fixed");
  } else {
    menu.classList.remove("fixed");
  }

}

function scrollToSection(event) {
  event.preventDefault(); // Ngăn chặn hành vi mặc định của thẻ <a href>

  const sectionId = event.target.getAttribute('href'); // Lấy giá trị của thuộc tính href

  const section = document.querySelector(sectionId); // Tìm phần tử có ID tương ứng

  if (section) {
    const offset = 75; // Khoảng cách từ top
    const topPos = section.offsetTop - offset; // Tính toán vị trí top cần cuộn đến

    window.scrollTo({
      top: topPos,
      behavior: 'smooth' // Cuộn mượt
    });
  }
}