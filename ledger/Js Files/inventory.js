//<script type="text/javascript" src="birbalcells.js"></script>


'use strict';

//import {default as inven} from './birbalCells.js';
window.addEventListener('load', function () {
    setDataOnStart(document.querySelector('#Table'));
    document.execCommand('defaultParagraphSeparator', false, null);
});

class CellElement extends HTMLElement {
    constructor() {
        super();
        this.attachShadow({ mode: 'open' });
        this.shadowRoot.innerHTML = document.querySelector('#tmpCell').innerHTML;
        this.style = `grid-column: ${this.col + 1} / ${this.col + 2}; grid-row: ${this.row + 1} / ${this.row + 2};`;
        let parent = this.parentNode, newRow = 0, newCol = 0, newCell = null, currentCell = null, balanceCell = null, countCell = null, rateCell = null, keydownEnable = true;;

        let r = this.maxRow;
        window.addEventListener('beforeunload', function (e) {
            this.dataBackup(parent);
            event.returnValue = true;
        });


        if (this.getAttribute('enabled') === 'false') {
            this.shadowRoot.querySelector('div').setAttribute('contenteditable', 'false');
        }
        
        this.addEventListener('focus', async (e) => {
           
                this.shadowRoot.querySelector('div').focus(
                    async (e) => {
                        e.preventDefault();
                    }
                )
        });

        this.style.backgroundColor = this.row % 2 == 0 ? 'RGBA(0,0,0,0.10)' : 'RGBA(0,0,0,0.20)';

        if (this.getAttribute('contentType') === 'input') {
            let a = document.createElement('input');
            a.type = 'checkbox';
            this.shadowRoot.querySelector('div').appendChild(a);
        }
        this.shadowRoot.querySelector('div').addEventListener('keydown', async (e) => {
            document.execCommand('defaultParagraphSeparator', false, null);
            for (let c of parent.querySelectorAll(`inven-cell[row="${this.row}"]`))
                backupContent.push(c.content);
                 if ([38, 40, 37, 39, 13, 9].includes(e.keyCode)&& keydownEnable){
            switch (e.keyCode) {
                 case 38:
                        await this.moveUp();
                        break;
                    case 40:
                        await this.moveDown();
                        break;
                    case 37:
                        await this.moveLeft();
                        break;
                    case 39:
                        await this.moveRight();
                        break;
                
                case 13:
                    e.preventDefault();
                    if(this.col==3){
                         getSelectedRows(parent).forEach(range => getUpdateData(range, parent, "Insert"));
                         count = 0;
                         buttonEvent = true;
                         break;
                    }
                    this.moveRight();
                    break;

            }
                 }
        });
        
          this.shadowRoot.querySelector('div').addEventListener('keyup', async (e) => {
                 if (e.keyCode == 113) {
                keydownEnable = keydownEnable == false ? true : false;
                return;
            } });
    }
    move(row, col) {
        let newCell = this.parentNode.querySelector(`inven-cell[row="${row}"][col="${col}"]`);
        newCell.focus();
    }
    moveUp() {
        this.move(this.row > 0 ? this.row - 1 : this.row, this.col);
    }
    moveDown() {
        this.move(this.row + 1, this.col);
    }
    moveLeft() {
        // if (getCaretPosition(this.shadowRoot.querySelector('div')) == 0)
        this.move(this.row, this.col > 0 ? this.col - 1 : this.col);
    }
    moveRight() {
        // if (getCaretPosition(this.shadowRoot.querySelector('div')) == this.content.length)
        this.move(this.row, this.col + 1);
    }

    get Cbox() {
        return this.parentNode.querySelector(`inven-checkbox[row="${this.row}"][col="${0}"]`).shadowRoot.querySelector('input');
    }

    set Cbox(value) {
        for (let c of this.parentNode.querySelectorAll(`inven-cell[row="${this.row}"]`)) {
            if (c.col > 1)
                c.shadowRoot.querySelector('div').setAttribute('contenteditable', value);
        }
        this.parentNode.querySelector(`inven-checkbox[row="${this.row}"][col="${0}"]`).shadowRoot.querySelector('input').checked = value;
    }

    get content() {
        return this.shadowRoot.querySelector('div').innerText;
    }

    set content(value) {
        this.shadowRoot.querySelector('div').innerText = value;
    }

    set status(value) {
        this.parentNode.shadowRoot.querySelector('.column-status .span0').innerText = value;
    }

    get status() {
        return this.parentNode.shadowRoot.querySelector('.column-status').content;
    }

    get col() {
        return parseInt(this.getAttribute('col'));
    }

    get row() {
        return parseInt(this.getAttribute('row'));
    }
}

let backupContent = [];

function setDataFromBackupContent(parent, range) {
    let i = 0;
    for (let c of parent.querySelectorAll(`inven-cell[row="${range}"]`)) {
        c.content = backupContent[i];
        i++;
    }
}

let currentSheet = [];
function backupInVariable(parent) {
    let sheetData = [['id'], ['rate'], ['itemname']];
    for (let i = 0; i <= parent.maxRow; i++) {
        sheetData[i] = new Array();
        for (let c of parent.querySelectorAll(`inven-cell[row="${i}"]`)) {
            switch (c.col) {
                case 1:
                    sheetData[i].id = c.content.length > 0 ? c.content : null;
                    break;
                case 2:
                    sheetData[i].itemname = c.content.length > 0 ? c.content : null;
                    break;
                case 3:
                    sheetData[i].rate = c.content.length > 0 ? c.content : null;
                    break;
            }

        }
    }
    for (var i = 0; i < sheetData.length; i++) {
        if (sheetData[i].id != null || sheetData[i].itemname != null || sheetData[i].rate != null) {
            currentSheet.push(sheetData[i]);
        }
    }
}

function dataBackup(parent) {
    let sheetData = [];
    for (let c of parent.querySelectorAll(`inven-cell`)) {

        sheetData.push(c.content.length != 0 ? c.content : null);
    }
    var JSONobj = JSON.stringify(sheetData);
    window.sessionStorage.setItem('Storeddata', JSONobj);
}

function storeRowData(parent, cell, command) {

    var sheetData = [];
    let transactionID = null;
    for (let c of parent.querySelectorAll(`inven-cell[row="${cell.row}"]`)) {
        switch (c.col) {

            case 1:
                transactionID = c;
                break;
            case 2:
                sheetData[2] = c.content;
                break;
            case 3:
                sheetData[3] = c.content;
                break;
            case 4:
                sheetData[4] = c.content;
                break;
            case 5:
                sheetData[5] = c.content;
                break;
            case 6:
                sheetData[6] = c.content;
                break;
            case 9:
                sheetData[8] = parseFloat('0' + c.content.replace(/\(|\)/g, ""));
                break;

        }

        sheetData[7] = cell.col == 7 ? 'Debit' : 'Credit';

    }
    var today = new Date();
    var date = today.getFullYear() + (today.getMonth() + 1) + today.getDate();
    var time = today.getHours() + '' + today.getMinutes() + '' + today.getSeconds();
    sheetData[1] = transactionID.content.length > 0 ? transactionID.content : date + '-' + time.replace(' ', '') + '-' + cell.row;
    storeInDB(parent, transactionID, JSON.stringify(sheetData));
}

function storeInDB(parent, transactionID, jsonData) {
    let statusBar = parent.shadowRoot.querySelector('.column-status');
    let DBStatus = statusBar.querySelector('.span0');
    var xhhtp = new XMLHttpRequest();
    var temp = JSON.parse(jsonData);
    xhhtp.onreadystatechange = function () {
        if (this.readyState == 4) {
            var str_pos = this.responseText.indexOf("Duplicate");
            if (str_pos > -1) {
                DBStatus.innerText = `Status: Duplciate ID:${temp[1]}`;
            }
            else {
                transactionID.content = temp[1];
                DBStatus.innerText = `Status: Row inserted ID:${temp[1]}`;
            }
        }
    }
    xhhtp.open('POST', 'database/modifyLedger.php', true);
    xhhtp.withCredentials = true;
    xhhtp.setRequestHeader('Content-Type', 'application/json');
    let query = temp[7] == "Debit" ? `insert into client_ledger values('${temp[1]}','${temp[2]}','${temp[3]}','${temp[4]}',${temp[5]},${temp[6]},1,0,'${temp[8]}')` :
        `insert into client_ledger values('${temp[1]}','${temp[2]}','${temp[3]}','${temp[4]}',${temp[5]},${temp[6]},0,1,'${temp[8]}')`;

    xhhtp.send(query);

};

function setDataOnStart(parent) {
    var xhhtp = new XMLHttpRequest();
    xhhtp.onreadystatechange = function () {
        if (this.readyState == 4) {
            inventory = this.responseText.indexOf('empty') > -1 ? 0 : JSON.parse(this.responseText);
            setInventory(parent, inventory);
        }

    };
    xhhtp.withCredentials = true;
    xhhtp.open('GET', 'database/fetchInventory.php', true);
    xhhtp.send();


}

function setInventory(parent, parsedData) {
    for (let i = 1; i <= parsedData.length; i++) {
        for (let c of parent.querySelectorAll(`inven-cell[row="${i}"]`)) {
            switch (c.col) {
                case 1:
                    c.content = parsedData[i - 1].id;
                    break;
                case 2:
                    c.content = parsedData[i - 1].itemname;
                    break;
                case 3:
                    c.content = parsedData[i - 1].itemrate;
                    break;
            }
        }
    }
}


class TableElement extends HTMLElement {

    __columns = [];
    __footers = [];
    __status = [];

    constructor() {
        super();
        this.attachShadow({ mode: 'open' });
        this.shadowRoot.innerHTML = document.querySelector('#tmpTable').innerHTML;
        this.columns = this.getAttribute('cols').split(',');
        this.status = this.getAttribute('stats').split(',');
        let parent = this;

        this.shadowRoot.querySelector('#update').addEventListener("click", function () {
            getSelectedRows(parent).forEach(range => getUpdateData(range, parent, "update"));
            count = 0;

        });
        this.shadowRoot.querySelector('#delete').addEventListener("click", function () {
            getSelectedRows(parent).forEach(range => getUpdateData(range, parent, "delete"));
            count = 0;
            buttonEvent = true;

        });
        this.shadowRoot.querySelector('#Add').addEventListener("click", function () {
            getSelectedRows(parent).forEach(range => getUpdateData(range, parent, "Insert"));
            count = 0;
            buttonEvent = true;
            //inven();
        });
    }

    set columns(value) {
        this.__columns = value;
        let headers = this.shadowRoot.querySelector('.column-headers');

        headers.style = `grid-template-columns:0.5fr 1fr 1fr 1fr;`;
        let html = "";
        for (let i = 0; i < this.__columns.length; ++i) {
            html += this.__columns[i] == 'Cbox' ? '<span><input type="checkbox"/></span>' : `<span>${this.__columns[i]}</span>`;
        }
        headers.innerHTML = html;
    }

    set status(value) {
        this.__status = value;
        let status = this.shadowRoot.querySelector('.column-status');

        this.shadowRoot.querySelector('.cells').style = `grid-template-status: repeat(${this.__status.length}, 1fr)`;
        status.style = `grid-template-status: repeat(${this.__status.length}, 1fr)`;
        let html = "";
        for (let i = 0; i < this.__status.length; ++i) {
            html += `<span class="span${i}">${this.__status[i]}</span>`;
        }

        status.innerHTML = html;
    }

    get status() {
        return this.__status;
    }

    get columns() {
        return this.__columns;
    }

    get maxCol() {
        return parseInt(this.querySelector('inven-cell:nth-last-of-type(1)').getAttribute('col'));
    }

    get maxRow() {
        return parseInt(this.querySelector('inven-cell:nth-last-of-type(1)').getAttribute('row'));
    }
}

let buttonEvent = false;

class invenCheckbox extends CellElement {

    constructor() {
        super();
        let parent = this.parentNode, parentCbox = parent.shadowRoot.querySelector('.column-headers input'), checkbox = this.shadowRoot.querySelector('input');;

        this.shadowRoot.querySelector('input').addEventListener('change', (e) => {
            if (checkbox.checked == true) {
                for (let c of parent.querySelectorAll(`inven-cell[row="${this.row}"]`)) {
                    if (c.col > 1)
                        c.shadowRoot.querySelector('div').setAttribute('contenteditable', 'true');
                }
            }
            else {
                for (let c of parent.querySelectorAll(`inven-cell[row="${this.row}"]`)) {
                    if (c.col > 1)
                        c.shadowRoot.querySelector('div').setAttribute('contenteditable', 'false');

                    if (buttonEvent == false)
                        setDataFromBackupContent(parent, c.row);
                }
            }
        });
        parent.shadowRoot.querySelector('.column-headers input').addEventListener('change', (e) => {
            for (let c of parent.querySelectorAll(`inven-checkbox[col="0"]`)) {

                checkbox.checked = parentCbox.checked;
            }
        });
    }

};

function getSelectedRows(parent) {
    var selectedRows = [];
    for (let c of parent.querySelectorAll(`inven-checkbox[col="0"]`)) {
        let checkbox = c.shadowRoot.querySelector('input');
        if (checkbox.checked == true) {
            selectedRows.push(c.row);
        }

    }
    return selectedRows;
}

let invenCells = null;
function getUpdateData(range, parent, requestFor) {
    var sheetData = [];
    let a = parent.querySelectorAll(`inven-cell[row="${range}"]`);
    for (let c of a) {

        switch (c.col) {
            case 1:
                sheetData[1] = c.content.length != 0 ? c.content : null;
                break;
            case 2:
                sheetData[2] = c.content.length != 0 ? c.content : null;
                break;
            case 3:
                sheetData[3] = c.content.length != 0 ? c.content : null;
                break;
        }
    }
    sheetData[0] = requestFor;
    invenCells = JSON.stringify(sheetData);
    if (sheetData[0].length > 0)
     modifyLedger(parent, range, a);

}

var count = 0;
function modifyLedger(parent, range) {
    let DBStatus = parent.shadowRoot.querySelector('.column-status').querySelector('.span0');
    var xhhtp = new XMLHttpRequest();
    var temp = JSON.parse(invenCells);
    xhhtp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            count = this.responseText.indexOf('successfull') > -1 ? count + 1 : count + 0;
            let lastid = this.responseText.split(':');
            DBStatus.innerText = 'Status: ' + temp[0] + ' successfull for :' + count + ' record(s)';
            if (temp[0] == 'delete') {
                for (let c of parent.querySelectorAll(`inven-cell[row="${range}"]`)) {
                    c.content = '';
                    c.Cbox = false;
                }
            }
            else if (temp[0] == 'update') {
                let key = this.responseText.split('for');
                DBStatus.innerText = this.responseText.indexOf('successfull') > -1 ? DBStatus.innerText : `Status: ${key[0]}`;
                for (let c of parent.querySelectorAll(`inven-cell[row="${range}"]`)) {
                    c.Cbox = false;
                }

            }
            else {
                let key = this.responseText.split('for');
                DBStatus.innerText = this.responseText.indexOf('successfull') > -1 ? DBStatus.innerText : `Status: ${key[0]}`;
                for (let c of parent.querySelectorAll(`inven-cell[row="${range}"]`)) {
                    c.Cbox = false;
                    c.content = c.col == 1 ? lastid[1] : c.content;
                }
            }
        }
    }
    xhhtp.withCredentials = true;
    xhhtp.open('POST', 'database/modifyLedger.php', true);
    xhhtp.withCredentials = true;
    let query = null;
    if (temp[0] == 'update') {
        query = `update \`${db}_inventory\` set item_name='${temp[2]}' ,item_rate=${temp[3]} where id=${temp[1]}`;
    }
    else if (temp[0] == 'delete') {
        query = `delete from \`${db}_inventory\` where id=${temp[1]}`;
    }
    else {
        query = `insert into \`${db}_inventory\` (item_name,item_rate) values('${temp[2]}',${temp[3]});`;
    }
    xhhtp.send(query);
};

let inventory = null;

class searchBar extends HTMLElement {
    __bar = [];
    constructor() {
        super();
        this.attachShadow({ mode: 'open' });
        this.shadowRoot.innerHTML = document.querySelector('#searchBar').innerHTML;
        let barElement = this.shadowRoot.querySelector('div');
        let matches = null, parent = document.querySelector("#Table"), backup = [];

        const operator = txt => {
            matches = currentSheet.filter(inventory => {
                const regex = new RegExp(`^${txt}`, 'gi');
                return inventory.itemname.match(regex);
            });
        }

        this.shadowRoot.querySelector('div').addEventListener('keydown', (e) => {
            backupInVariable(parent);
            switch (e.keyCode) {
                case 13:
                    (operator(barElement.innerText));
                    this.searchFunction(matches, backup);
                    e.preventDefault();
                    break;
                case 9:
                    e.preventDefault;
                    break;
                case 8:
                    if (barElement.innerText.length < 2) {
                        this.searchEnd(backup);
                    }
                    break;
            }
        });
    }
    searchFunction(matches, backup) {
        let searchContent = [];
        let arr = document.querySelector("#Table").querySelectorAll('inven-cell[col="2"]');
        for (let c of arr) {
            matches.forEach(match => {
                if (c.content.length > 0 && c.content == match.itemname) {
                    c.shadowRoot.querySelector('div').style['color'] = 'blue';
                    c.shadowRoot.querySelector('div').style['border'] = '1px solid blue';
                }
            });
            backup.push(c);
        }
    }
    searchEnd(arr) {
        for (let c of arr) {
            c.shadowRoot.querySelector('div').style['color'] = 'black';
            c.shadowRoot.querySelector('div').style['border'] = '';
        }
    }

};



window.customElements.define('inven-searchbar', searchBar);
window.customElements.define('inven-table', TableElement);
window.customElements.define('inven-cell', CellElement);
window.customElements.define('inven-checkbox', invenCheckbox);


function generateCells(e) {
    let html = '', rowCount = 0;
    rowCount = e != 0 ? e.maxRow : 0;
    let ledger = document.querySelector('#Table');
    for (let r = rowCount + 1; r <= rowCount + 100; ++r) {
        for (let c = 0; c < 4; ++c) {
            if (c == 0) {
                html += `<inven-checkbox slot="checkbox" row="${r}" col="${c}" tabindex="0" contentType ="input" enabled="false"></inven-checkbox>`;
            }
            else {
                html += `<inven-cell slot="cells" row="${r}" col="${c}" tabindex="0" contentType ="text" enabled="false"></inven-cell>`;
            }

        }
    }
    let b = ledger.innerHTML;
    ledger.innerHTML += (b + html);
}
generateCells(0);