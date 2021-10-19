'use strict';

window.addEventListener('load', async function () {
    document.querySelector("#MainPage").shadowRoot.querySelector("div > div.navbar > div.options > a.OPLedger").classList.add('activated');
});

let backupContent = [];
class mainPage extends HTMLElement {
    __opts = [];
    __columns = [];

    constructor() {
        super();
        this.attachShadow({ mode: 'open' });
        this.shadowRoot.innerHTML = document.querySelector('#tmpMainPage').innerHTML;
        this.columns = this.getAttribute('col').split(',');
        this.options = this.getAttribute('opts').split(',');
        let optsActive = this.shadowRoot.querySelectorAll('a');
        let content = this.shadowRoot.querySelector('.content').querySelectorAll('div');


        for (let c of content) {
            c.innerHTML = `<object type="text/html" data="${c.className}.php" style="height:100%; width:100%;">
                    </object>`;
        }
    }

    set options(value) {
        this.__opts = value;
        let headers = this.shadowRoot.querySelector('.navbar').querySelector('.options');
        let html = "";
        for (let i = 0; i < this.__opts.length; ++i) {
            html += this.__opts[i] = `<a onclick=activateDisplay(this) class="OP${this.__opts[i]}">${this.__opts[i]}</a>
             `;
        }
        headers.innerHTML = html;
    }
}

function activateDisplay(element) {
    let content = document.querySelector('#MainPage').shadowRoot.querySelectorAll('.content div');
    let arr = document.querySelector('#MainPage').shadowRoot.querySelectorAll('.options a');
    for (let a of arr) {
        a.classList.remove('activated');
    }
    element.classList.add('activated');

    switch (element.innerText.toLowerCase()) {
        case 'inventory':
            for (let c of content) {
                c.style.display = c.className.toLowerCase() == 'inventory' ? 'block' : 'none';
            }
            break;
        case 'ledger':
            for (let c of content) {
                c.style.display = c.className.toLowerCase() == 'cells' ? 'block' : 'none';
            }
            break;
        case 'graph':
            for (let c of content) {
                c.style.display = c.className.toLowerCase() == 'graph' ? 'block' : 'none';
            }
            break;
        case 'settings':
            for (let c of content) {
                c.style.display = c.className.toLowerCase() == 'settings' ? 'block' : 'none';
            }
            break;
    }
}

function getBody(content) {
    var x = content.indexOf("<body");
    x = content.indexOf(">", x);
    var y = content.lastIndexOf("</body>");
    return content.slice(x + 1, y);
}

function getContent(content, target) {
    target.innerHTML = getBody(content);
}

window.customElements.define('bbl-mainpage', mainPage);

