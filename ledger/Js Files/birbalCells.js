'use strict';

window.addEventListener('load', async function () {
    await Promise.all([setDataOnStart(document.querySelector('#ledger')),
        document.execCommand('defaultParagraphSeparator', false, null)
    ]);
});

class CellElementLedger extends HTMLElement {
    constructor() {
        super();
        this.attachShadow({
            mode: 'open'
        });
        this.shadowRoot.innerHTML = document.querySelector('#tmpCell').innerHTML;
        let cell = this.shadowRoot.querySelector('div');
        this.style = `grid-column: ${this.col + 1} / ${this.col + 2}; grid-row: ${this.row + 1} / ${this.row + 2};`;
        let parent = this.parentNode,
            keydownEnable = true;
        /* window.addEventListener('beforeunload', function (e) {
             //  this.dataBackup(parent);
             event.returnValue = true;
 
         });*/
        /* this.shadowRoot.querySelector('div').addEventListener('focus', async (e) => {
             e.preventDefault();
         });*/

       if (this.col == 2 || this.col == 5 || this.col == 6) {
        this.addEventListener('focus', async (e) => {
                await Promise.all([
                    this.setDate(parent, this.row),
                    calculateTotal(parent),
                    this.shadowRoot.querySelector('div > input').focus(async (e) => {
                        e.preventDefault();
                    })
                ]) 
            });
            }
            else {
                this.addEventListener('focus', async (e) => {
                await Promise.all([
                    this.setDate(parent, this.row),
                    e.preventDefault(),
                    calculateTotal(parent),
                    this.shadowRoot.querySelector('div').focus(
                        async (e) => {
                            e.preventDefault();
                        }
                    )
                ]);
                });
            }
        

        let matches = [];
        const operator = async (txt) => {
            matches = (inven.filter((item) => {
                const regex = new RegExp(`^${txt}`, 'gi');
                return item.itemname.match(regex);
            }));
        }

        if (this.getAttribute('enabled') === 'false') {
            this.shadowRoot.querySelector('div').setAttribute('contenteditable', 'false');
        }
        /*else if (this.getAttribute('values') === 'numeric') {
                   var reg = new RegExp('^[0-9]+$');
                   this.shadowRoot.querySelector('div').addEventListener('keydown', async (e) => {
                       if (e.keyCode >= 65 && e.keyCode <= 90) {
                           e.preventDefault();
                           return false;
                       }
                   });
               }*/

        if (this.getAttribute('contentType') === 'input') {
            let a = document.createElement('input');
            a.type = 'checkbox';
            this.shadowRoot.querySelector('div').appendChild(a);
        } else if (this.getAttribute('contentType') === 'date') {
            let a = document.createElement('input');
            a.type = 'date';
            this.shadowRoot.querySelector('div').appendChild(a);
        }

        if (this.getAttribute('values') === 'numeric') {
            let a = document.createElement('input');
            a.type = 'number';
            a.min = '1';
            this.shadowRoot.querySelector('div').appendChild(a);
        }

        this.shadowRoot.querySelector('div').addEventListener('blur', async (e) => {
            if (this.col == 3)
                await this.setSuggestion('');
        });

        if (this.col == 1 || this.col == 9) {
            this.shadowRoot.querySelector('div').addEventListener('keydown', async (e) => {
                if ((![38, 40, 37, 39, 13, 9].includes(e.keyCode))) {
                    e.preventDefault();
                    return;
                }
            })
        }

 if ([8, 7].includes(this.col)){
        this.shadowRoot.querySelector('div').addEventListener('keydown', async (e) => {
            let transID = '';
            if (e.keyCode == 13) {
                await Promise.all([
                    calculateTotal(parent),
                    transID = this.parentNode.querySelector(`bbl-cell[row="${this.row}"][col="${1}"]`)
                ]);
                if (transID.content.length <= 0 && this.Cbox.checked == false) {
                    //let graph = new graphElement();
                    await Promise.all([
                        this.invalidateBalance(),
                        storeRowData(parent, this),
                    ]);
                } else if (transID.content.length > 0 && this.Cbox.checked == true) {
                    await Promise.all([
                        this.invalidateBalance(),
                        this.status = 'Status:Press update to confirm insertion.'
                    ]);
                } else {
                    this.status = 'Status:Record already exists try update/delete.';
                }
                
            }
        });
}
        this.shadowRoot.querySelector('div').addEventListener('keydown', async (e) => {
            /* if ((![38, 40, 37, 39, 13, 9].includes(e.keyCode)) && (this.col == 1 || this.col == 9)) {
                 e.preventDefault();
                 return;
             }
            let transID = '';
            e.stopPropagation(); [38, 40, 37, 39, 13, 9].includes(e.keyCode) &&*/
             e.stopPropagation();
            if (keydownEnable) {
                switch (e.keyCode) {
                    case 9:
                        e.preventDefault();
                        break;
                    case 38:
                        await this.moveUp();
                        e.preventDefault();
                        break;
                    case 40:
                        await this.moveDown();
                        e.preventDefault();
                        break;
                    case 37:
                        await this.moveLeft();
                        e.preventDefault();
                        break;
                    case 39:
                        await this.moveRight();
                        e.preventDefault();
                        break;
                    case 13:
                        /*if ([8, 7].includes(this.col)) {
                            await Promise.all([
                                calculateTotal(parent),
                                transID = this.parentNode.querySelector(`bbl-cell[row="${this.row}"][col="${1}"]`)
                            ]);
                            if (transID.content.length <= 0 && this.Cbox.checked == false) {
                                //let graph = new graphElement();
                                await Promise.all([
                                    this.invalidateBalance(),
                                    storeRowData(parent, this),
                                ]);
                            } else if (transID.content.length > 0 && this.Cbox.checked == true) {
                                await Promise.all([
                                    this.invalidateBalance(),
                                    this.status = 'Status:Press update to confirm insertion.'
                                ]);
                            } else {
                                this.status = 'Status:Record already exists try update/delete.';
                            }
                        }*/
                        //  else {
                        if([8, 7].includes(this.col))return;
                        await this.moveRight();
                        e.preventDefault();
                        //}
                        break;
                }
            }
        });

        /*if (this.col == 3) {
            this.shadowRoot.querySelector('div').addEventListener('keyup', async (e) => {
                let length = this.content.length;
                let rateCell = this.parentNode.querySelector(`bbl-cell[row="${this.row}"][col="${6}"]`);
                let str = '';
                await Promise.all([length, operator(this.content), rateCell]);
                if (e.keyCode == 9) {
                    await Promise.all([
                        e.preventDefault(),
                        rateCell.inputValue = matches[0].itemrate,
                        this.content = matches[0].itemname,
                        this.moveRight()
                    ]);
                } else if (length > 0 && e.keyCode != 9) {
                    try {
                        await Promise.all([
                            str = matches[0].itemname.substring(this.content.length),
                            this.setSuggestion(str)
                        ]);
                    } catch (e) {}
                } else if (e.keyCode == 8 && this.content.length < 1) this.setSuggestion('');
            });
        }*/

        this.shadowRoot.querySelector('div').addEventListener('keyup', async (e) => {
            if (e.keyCode == 113) {
                keydownEnable = keydownEnable == false ? true : false;
                return;
            }
           


            if (this.col == 3) {
                let length = this.content.length;
                let rateCell = this.parentNode.querySelector(`bbl-cell[row="${this.row}"][col="${6}"]`);
                let str = '';
                await Promise.all([length, operator(this.content), rateCell]);
                if (e.keyCode == 9) {
                    await Promise.all([
                        e.preventDefault(),
                        rateCell.inputValue = matches[0].itemrate,
                        this.content = matches[0].itemname,
                        this.moveRight()
                    ]);
                     return;
                } else if (length > 0 && e.keyCode != 9) {
                    try {
                        await Promise.all([
                            str = matches[0].itemname.substring(this.content.length),
                            this.setSuggestion(str)
                        ]);
                    } catch (e) {}
                } else if (e.keyCode == 8 && this.content.length < 1) this.setSuggestion('');

            } 
            else if(e.keyCode == 9){
                e.preventDefault();
                this.moveRight();
            }

        });

    }

    async setSuggestion(str) {
        this.shadowRoot.querySelector('div').setAttribute('placeholder', str);
    }

    async setDate(parent, row) {
        let dateCol = this.parentNode.querySelector(`bbl-cell[row="${row}"][col="${2}"]`).shadowRoot.querySelector('div > input[type=date]');
        var today = new Date();
        var date = new Date(today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + today.getDate()).toISOString().slice(0, 10);
        // dateCol.value = dateCol.value date;
        await Promise.all([dateCol, today, date, dateCol.value = dateCol.value.length == 0 || dateCol.value.length < 1 ? date : dateCol.value]);
    }

    async move(row, col) {
        let newCell = this.parentNode.querySelector(`bbl-cell[row="${row}"][col="${col}"]`);
        await Promise.all([newCell, newCell.focus()]);

    }
    async moveUp() {
        let row = this.row,
            col = this.col,
            newRow = row > 0 ? row - 1 : row;
        await Promise.all([row, col, newRow, this.move(newRow, col)]);
    }
    async moveDown() {
        let row = this.row + 1,
            col = this.col;
        await Promise.all([row, col, this.move(row, col)]);
    }
    async moveLeft() {
        let row =    this.col == 1 ? this.row - 1 : this.row;
        let newCol = this.col > 1 ? this.col - 1 : 9;
        await Promise.all([row, newCol, this.move(row, newCol)]);
    }
    async moveRight() {
        let row = this.col == 9 ? this.row + 1 : this.row;
        let col = this.col == 9 ? 1 :this.col + 1;
        await Promise.all([row, col, this.move(row, col)]);
    }
    /* moveForward() {
         this.move(this.row + 1, this.col = 1);
     }
     moveBackward() {
         this.move(this.row - 1, this.col = 9);
     }*/

    get Cbox() {
        return this.parentNode.querySelector(`bbl-checkbox[row="${this.row}"][col="${0}"]`).shadowRoot.querySelector('div').querySelector('input');
    }


    get content() {
        return this.shadowRoot.querySelector('div').innerText;

    }
    get inputValue() {
        return this.shadowRoot.querySelector('div >input').value;

    }
    set inputValue(value) {
        this.shadowRoot.querySelector('div >input').value = value;

    }
    set content(value) {
        this.shadowRoot.querySelector('div').innerText = value;
    }

    async invalidateBalance() { // TODO: Rusab, we need more enhancement here
        let cells = this.parentNode.querySelectorAll(`bbl-cell[row="${this.row}"]`);
        let balance = cells[5].inputValue * cells[4].inputValue;
        let col = this.col;
        await Promise.all([cells, balance, col, this.move(this.row + 1, 3)]);

        if (col == 7) {
            cells[cells.length - 1].content = `(${balance})`;
            this.content = 'YES';
            cells[7].content = '';
        } else if (col == 8) {
            cells[cells.length - 1].content = `${balance}`;
            this.content = 'YES';
            cells[6].content = '';
        }

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

function dataBackup(parent) {
    let sheetData = [];
    for (let c of parent.querySelectorAll(`bbl-cell`)) {

        sheetData.push(c.content.length != 0 ? c.content : null);
    }
    var JSONobj = JSON.stringify(sheetData);
    window.sessionStorage.setItem('Storeddata', JSONobj);
}

let currentSheetLedger = [];

function backupInVariable(parent) {
    let sheetData = [
        ['transID'],
        ['date'],
        ['itemname'],
        ['detail'],
        ['itm_count'],
        ['item_rate'],
        ['debit'],
        ['credit'],
        ['balance']
    ];
    for (let i = 0; i <= parent.maxRow; i++) {
        sheetData[i] = new Array();
        for (let c of parent.querySelectorAll(`bbl-cell[row="${i}"]`)) {
            switch (c.col) {
                case 1:
                    sheetData[i].transID = c.content.length > 0 ? c.content : null;
                    break;
                case 2:
                    sheetData[i].date = c.content.length > 0 ? c.content : null;
                    break;
                case 3:
                    sheetData[i].itemname = c.content.length > 0 ? c.content : null;
                    break;
                case 4:
                    sheetData[i].detail = c.content.length > 0 ? c.content : null;
                    break;
                case 5:
                    sheetData[i].itm_count = c.content.length > 0 ? c.content : null;
                    break;
                case 6:
                    sheetData[i].item_rate = c.content.length > 0 ? c.content : null;
                    break;
                case 7:
                    sheetData[i].debit = c.content.length > 0 ? 1 : null;
                    break;
                case 8:
                    sheetData[i].credit = c.content.length > 0 ? 1 : null;
                    break;
                case 9:
                    sheetData[i].balance = c.content.length > 0 ? c.content.replace(/\(|\)/g, "") : null;
                    break;

            }

        }
    }
    for (var i = 0; i < sheetData.length; i++) {
        if (sheetData[i].transID != null || sheetData[i].logDate != null ||
            sheetData[i].detail != null || sheetData[i].item_name != null ||
            sheetData[i].item_count != null || sheetData[i].item_rate != null ||
            sheetData[i].debit != null || sheetData[i].credit != null || sheetData[i].balance != null) {
            currentSheetLedger.push(sheetData[i]);
        }
    }
}

async function storeRowData(parent, cell, command) {

    var sheetData = [];
    let transactionID = parent.querySelector(`bbl-cell[row="${cell.row}"][col="1"]`);

    for await (let c of parent.querySelectorAll(`bbl-cell[row="${cell.row}"]`)) {
        switch (c.col) {
            case 2:
                sheetData[2] = c.inputValue;
                break;
            case 3:
                sheetData[3] = c.content;
                break;
            case 4:
                sheetData[4] = c.content;
                break;
            case 5:
                sheetData[5] = c.inputValue;
                break;
            case 6:
                sheetData[6] = c.inputValue;
                break;
            case 9:
                sheetData[8] = parseFloat('0' + c.content.replace(/\(|\)/g, ""));
                break;

        }
    }

    sheetData[7] = cell.col == 7 ? 'Debit' : 'Credit';


    var today = new Date();
    var date = today.getFullYear() + (today.getMonth() + 1) + today.getDate();
    var time = today.getHours() + '' + today.getMinutes() + '' + today.getSeconds();
    sheetData[1] = transactionID.content.length > 0 ? transactionID.content : date + '-' + time.replace(' ', '') + '-' + cell.row;
    await Promise.all(sheetData[1], sheetData, transactionID, today, date, time, storeInDB(parent, transactionID, JSON.stringify(sheetData)));

}

async function storeInDB(parent, transactionID, jsonData) {
    let statusBar = parent.shadowRoot.querySelector('.column-status');
    let DBStatus = statusBar.querySelector('.span0');
    var xhhtp = new XMLHttpRequest();
    var temp = JSON.parse(jsonData);
    let query = temp[7] == "Debit" ? `insert into \`${db}_ledger\` values('${temp[1]}','${temp[2]}','${temp[3]}','${temp[4]}',${temp[5]},${temp[6]},1,0,'${temp[8]}')` :
        `insert into \`${db}_ledger\` values('${temp[1]}','${temp[2]}','${temp[3]}','${temp[4]}',${temp[5]},${temp[6]},0,1,'${temp[8]}')`;

    await Promise.all([statusBar, DBStatus, temp, xhhtp, query]);

    xhhtp.onreadystatechange = async function () {
        if (this.readyState == 4 && this.status == 200) {
            var str_pos = this.responseText.indexOf("successfull");
            if (str_pos > -1) {
                transactionID.content = temp[1];
                DBStatus.innerText = `Status: Row inserted ID:${temp[1]}`;

            } else {
                DBStatus.innerText = `Status: Duplciate ID:${temp[1]}`;
            }
        }
    }
    xhhtp.open('POST', 'database/modifyLedger.php', true);
    xhhtp.setRequestHeader('Content-Type', 'application/json');
    xhhtp.send(query);

};


async function fetchInventory() {
    var xhhtp = new XMLHttpRequest();
    var data = null;

    xhhtp.onreadystatechange = async function () {
        if (this.readyState == 4 && this.status == 200) {
            inven = await JSON.parse(this.responseText);
        }
    }
    xhhtp.withCredentials = true;
    xhhtp.open('GET', 'database/fetchInventory.php', true);
    xhhtp.send();
    await Promise.all([xhhtp, data]);
};


async function getFormattedDate(date) {
    var year = date.getFullYear();

    var month = (1 + date.getMonth()).toString();
    month = month.length > 1 ? month : '0' + month;

    var day = date.getDate().toString();
    day = day.length > 1 ? day : '0' + day;

    var dateFinal = month + '-' + day + '-' + year;

    return await Promise.all([year, month, day, dateFinal]);
}


let maxDate = [2];
maxDate[0] = '';
maxDate[1] = '';

async function calculateTotal(parent) {
    let footer = parent.shadowRoot.querySelector('.column-footer');
    let maxCount = 0,
        maxItems = 0,
        maxDebit = 0,
        maxCredit = 0,
        maxBalance = 0,
        tickCount = 0;
    await Promise.all([footer, maxCount,
        maxItems,
        maxDebit,
        maxCredit,
        maxBalance,
        tickCount
    ]);

    for await (let c of parent.querySelectorAll(`bbl-cell[col="9"]`)) {
        let balanceCell = c.content;
        balanceCell = balanceCell.indexOf('(') === 0 ? '-0' + balanceCell.replace(/\(|\)/g, "") : '0' + balanceCell;
        balanceCell = parseFloat(balanceCell);
        maxBalance += balanceCell;
    }
    for await (let c of parent.querySelectorAll(`bbl-cell[col="8"]`)) {
        let balanceCell = parseFloat(parent.querySelector(`bbl-cell[row="${c.row}"][col="9"]`).content);
        maxCredit = c.content.length != 0 && c.content == 'YES' ? maxCredit + balanceCell : maxCredit + 0;
    }
    for await (let c of parent.querySelectorAll(`bbl-cell[col="7"]`)) {
        let balanceCell = parseFloat(parent.querySelector(`bbl-cell[row="${c.row}"][col="9"]`).content.replace(/\(|\)/g, ""));
        maxDebit = c.content.length != 0 && c.content == 'YES' ? maxDebit + balanceCell : maxDebit + 0;
    }
    for await (let c of parent.querySelectorAll(`bbl-cell[col="5"]`)) {
        let balance = c.inputValue.length != 0 ? c.inputValue : 0;
        balance = parseFloat(balance);
        maxItems = maxItems + balance;
    }
    for await (let c of parent.querySelectorAll(`bbl-cell[col="3"]`)) {
        let balance = c.content;
        maxCount = balance.length != 0 ? maxCount + 1 : maxCount + 0;
    }
    for await (let c of parent.querySelectorAll(`bbl-cell[col="2"]`)) {
        maxDate[0] = maxDate[0].length < 1 ? c.inputValue : maxDate[0];
        maxDate[1] = maxDate[1].length < 1 ? c.inputValue : maxDate[1];
        if (c.inputValue.length > 0) {
            let cdt = new Date(c.inputValue);
            let dt1 = new Date(maxDate[0]);
            let dt2 = new Date(maxDate[1]);
            maxDate[0] = cdt < dt1 ? c.inputValue : (maxDate[0]);
            maxDate[1] = cdt > dt2 ? c.inputValue : (maxDate[1]);
        }
    }
    for await (let c of parent.querySelectorAll(`bbl-checkbox[col="0"]`)) {
        let checkbox = c.shadowRoot.querySelector('input');
        tickCount = checkbox.checked == true ? tickCount + 1 : tickCount + 0;
    }

    totalValues(footer, maxDate, maxCount, maxItems, maxDebit, maxCredit, maxBalance, tickCount);
}


async function totalValues(footer, maxDate, maxCount, maxItems, maxDebit, maxCredit, maxBalance, maxSelected) {

    let totalCheck = footer.querySelector('.span0');
    let date = footer.querySelector('.span1');
    let item_count = footer.querySelector('.span2');
    let total_count = footer.querySelector('.span3');
    let debit = footer.querySelector('.span4');
    let credit = footer.querySelector('.span5');
    let ttl_bal = footer.querySelector('.span6');
    await Promise.all([
        date.innerText = 'Date Range:' + maxDate[0] + ' : ' + maxDate[maxDate.length - 1],
        totalCheck.innerText = 'Total Selected: ' + maxSelected,
        item_count.innerText = 'Item Count: ' + maxCount,
        total_count.innerText = 'Total Count: ' + maxItems,
        debit.innerText = 'Total Expense : ' + maxDebit,
        credit.innerText = 'Total Income: ' + maxCredit,
        ttl_bal.innerText = 'Total Balance: ' + maxBalance
    ]);
};


async function setDataOnStart(parent) {
    var xhhtp = new XMLHttpRequest();
    var parsedData = null;
    xhhtp.onreadystatechange = async function () {
        if (this.readyState == 4) {
            await Promise.all([
                parsedData = this.responseText.indexOf('empty') > -1 ? 0 : JSON.parse(this.responseText),
                setLedger(parent, parsedData),
                calculateTotal(parent)
            ]);
        }

    };
    xhhtp.withCredentials = true;
    xhhtp.open('GET', 'database/fetchSum.php', true);
    xhhtp.send();
}

async function setLedger(parent, parsedData) {
    if (parent.maxRow < parsedData.length)
        generateCells(0, parsedData.length + 100);

    for (let i = 1; i <= parsedData.length; i++) {
        for (let c = 1; c <= 9; c++) {
            let bblCell = parent.querySelector(`bbl-cell[row="${i}"][col="${c}"]`);
            switch (c) {
                case 1:
                    bblCell.content = parsedData[i - 1].transID;
                    break;
                case 2:
                    bblCell.inputValue = parsedData[i - 1].date;
                    break;
                case 3:
                    bblCell.content = parsedData[i - 1].itemname;
                    break;
                case 4:
                    bblCell.content = parsedData[i - 1].detail;
                    break;
                case 5:
                    bblCell.inputValue = parsedData[i - 1].itm_count;
                    break;
                case 6:
                    bblCell.inputValue = parsedData[i - 1].item_rate;
                    break;
                case 7:
                    bblCell.content = parsedData[i - 1].debit == 1 ? 'YES' : null;
                    break;
                case 8:
                    bblCell.content = parsedData[i - 1].credit == 1 ? 'YES' : null;
                    break;
                case 9:
                    let debit = parent.querySelector(`bbl-cell[row="${i}"][col="${7}"]`);
                    bblCell.content = debit.content.length > 0 ? '(' + parsedData[i - 1].balance + ')' : parsedData[i - 1].balance;
                    break;
            }
        }
    }

    calculateTotal(parent);
}

function storeJSON(parent) {
    var sheetData = [
        [],
        []
    ];
    sheetData[0] = [], sheetData[1] = [], sheetData[2] = [], sheetData[3] = [], sheetData[4] = [], sheetData[5] = [], sheetData[6] = [], sheetData[7] = [];
    for (let c of parent.querySelectorAll(`bbl-cell[col="7"]`)) {
        sheetData[7][c.row] = c.content.length != 0 ? c.content : null;

    }
    for (let c of parent.querySelectorAll(`bbl-cell[col="6"]`)) {
        sheetData[6][c.row] = c.content.length != 0 ? c.content : null;

    }
    for (let c of parent.querySelectorAll(`bbl-cell[col="5"]`)) {
        sheetData[5][c.row] = c.content.length != 0 ? c.content : null;
    }
    for (let c of parent.querySelectorAll(`bbl-cell[col="4"]`)) {
        sheetData[4][c.row] = c.content.length != 0 ? c.content : null;
    }

    for (let c of parent.querySelectorAll(`bbl-cell[col="3"]`)) {
        sheetData[3][c.row] = c.content.length != 0 ? c.content : null;
    }

    for (let c of parent.querySelectorAll(`bbl-cell[col="2"]`)) {
        sheetData[2][c.row] = c.content.length != 0 ? c.content : null;
    }
    for (let c of parent.querySelectorAll(`bbl-cell[col="1"]`)) {
        sheetData[1][c.row] = c.content.length != 0 ? c.content : null;
    }

    for (let c of parent.querySelectorAll(`bbl-cell[col="0"]`)) {
        sheetData[0][c.row] = c.content.length != 0 ? c.content : null;
    }

    window.sessionStorage.setItem('Storeddata', JSONobj);

};

class LedgerElement extends HTMLElement {

    __columns = [];
    __footers = [];
    __months = [];

    constructor() {
        super();
        this.attachShadow({
            mode: 'open'
        });
        this.shadowRoot.innerHTML = document.querySelector('#tmpLedger').innerHTML;
        let parent = this,
            months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        this.columns = this.getAttribute('cols').split(',');
        this.footers = this.getAttribute('fot').split(',');
        this.status = this.getAttribute('stats').split(',');
        this.months = months;
        var d = new Date();
        var n = d.getUTCMonth();
        this.currentMonth = months[n];

        this.shadowRoot.querySelector('#update').addEventListener("click", async function () {
            await Promise.all([
                getSelectedRows(parent).then((arrList) => {
                    arrList.forEach(range => getUpdateData(range, parent, "update"))
                }),
                count = 0,
                calculateTotal(parent)
            ]);
        });
        this.shadowRoot.querySelector('#inventory').addEventListener("click", async function () {
            fetchInventory();
          
        });
        this.shadowRoot.querySelector('#delete').addEventListener("click", async function () {

            await Promise.all([
                getSelectedRows(parent).then((arrList) => {
                    arrList.forEach(range => getUpdateData(range, parent, "delete"))
                }),
                count = 0,
                calculateTotal(parent)
            ]);
        });
        this.shadowRoot.querySelector('#prevMonth').addEventListener("click", async function () {
            if (n >= months.length - 11) {
                parent.currentMonth = months[n - 1];
                n = n - 1;
            }
            calculateTotal(parent);
        });
        this.shadowRoot.querySelector('#nxtMonth').addEventListener("click", async function () {
            if (n < months.length - 1) {
                parent.currentMonth = months[n + 1];
                n = n + 1;
            }
            calculateTotal(parent);
        });
        this.shadowRoot.querySelector('#current').addEventListener("click", async function () {
            await Promise.all([
                generateCells(1, 100),
                setDataOnStart(parent)
            ]);
        });
        this.shadowRoot.querySelector('.currentMonth').addEventListener("click", async function () {
            fetchMonthlyLedger(parent, n + 1);
        });
    }

    set currentMonth(value) {
        document.querySelector('#ledger').shadowRoot.querySelector('.currentMonth').innerText = [value];
    }

    set columns(value) {
        this.__columns = value;
        let headers = this.shadowRoot.querySelector('.column-headers');
        this.shadowRoot.querySelector('.cells').style = `grid-template-columns:0.5fr 1fr 1fr 1fr 1fr 1fr 1fr 1fr 1fr 1fr;`;
        headers.style = `grid-template-columns:0.5fr 1fr 1fr 1fr 1fr 1fr 1fr 1fr 1fr 1fr;`;
        let html = "";
        for (let i = 0; i < this.__columns.length; ++i) {
            html += this.__columns[i] == 'Cbox' ? '<span><input type="checkbox"/></span>' : `<span>${this.__columns[i]}</span>`;
        }

        headers.innerHTML = html;
    }

    set footers(value) {
        this.__footers = value;
        let footer = this.shadowRoot.querySelector('.column-footer');

        this.shadowRoot.querySelector('.cells').style = `grid-template-footer: repeat(${this.__footers.length}, 1fr)`;
        footer.style = `grid-template-footer: repeat(${this.__footers.length}, 1fr)`;
        let html = "";
        for (let i = 0; i < this.__footers.length; ++i) {
            html += `<span class="span${i}">${this.__footers[i]}</span>`;
        }

        footer.innerHTML = html;
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

    get footers() {
        return this.__footers;
    }

    get columns() {
        return this.__columns;
    }

    get maxCol() {
        return parseInt(this.querySelector('bbl-cell:nth-last-of-type(1)').getAttribute('col'));
    }

    get maxRow() {
        return parseInt(this.querySelector('bbl-cell:nth-last-of-type(1)').getAttribute('row'));
    }
}

async function fetchMonthlyLedger(parent, month) {
    var d = new Date();
    let year = d.getFullYear();
    let query = `select * from \`${db}_ledger\` where logdate between'${year}-${month}-01' and '${year}-${month}-31'`;
    let DBStatus = parent.shadowRoot.querySelector('.column-status').querySelector('.span0');
    DBStatus.innerText = 'Status: Fetching record(s)';
    var xhhtp = new XMLHttpRequest();
    let parsedData = '';
    await Promise.all([d, year, query, DBStatus, xhhtp]);

    xhhtp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            parsedData = JSON.parse(this.responseText);
            DBStatus.innerText = `Status:Fetched ${parsedData.length} record(s)`;
            setLedger(parent, parsedData);
        }
    }
    xhhtp.withCredentials = true;
    xhhtp.open('POST', 'database/fetchQuery.php', true);
    xhhtp.send(query);
};

let cells = null;

class CheckboxElement extends CellElementLedger {

    constructor() {
        super();
        let parent = this.parentNode,
            parentCbox = parent.shadowRoot.querySelector('.column-headers input'),
            maxSelected = 0,
            checkbox = [],
            footer = null,
            totalCheck = null,
            cboxArray = parent.querySelectorAll(`bbl-checkbox[col="0"]`);
        try {
            for (let c of cboxArray) {
                checkbox.push(c.shadowRoot.querySelector('div').querySelector('input'))
            }
        } catch {}

        this.shadowRoot.querySelector('input').addEventListener('change', async (e) => {
            await calculateTotal(parent);
        });
        parent.shadowRoot.querySelector('.column-headers input').addEventListener('change', async (e) => {
            maxSelected = 0;
            for (let c of checkbox) {
                await Promise.all([,
                    c.checked = parentCbox.checked,
                    maxSelected = c.checked == true ? maxSelected + 1 : 0
                ]);
            }
            await Promise.all([
                footer = parent.shadowRoot.querySelector('.column-footer'),
                totalCheck = footer.querySelector('.span0'),
                totalCheck.innerText = 'Total Selected: ' + maxSelected
            ]);
        });
    }
};

async function getSelectedRows(parent) {
    var selectedRows = [];
    var arr = parent.querySelectorAll(`bbl-checkbox[col="0"]`);
    await Promise.all([selectedRows = [], arr]);
    for (let c of arr) {
        let checkbox = c.shadowRoot.querySelector('input');
        if (checkbox.checked == true) {
            selectedRows.push(c.row);
        }

    }
    return selectedRows;
}

async function getUpdateData(range, parent, requestFor) {
    let sheetData = [];
    for (let c = 1; c <= 9; c++) {
        let bblCell = parent.querySelector(`bbl-cell[row="${range}"][col="${c}"]`);
        switch (c) {
            case 1:
                sheetData[1] = bblCell.content.length != 0 ? bblCell.content : null;
                break;
            case 2:
                sheetData[2] = bblCell.inputValue.length != 0 ? bblCell.inputValue : null;
                break;
            case 3:
                sheetData[3] = bblCell.content.length != 0 ? bblCell.content : null;
                break;
            case 4:
                sheetData[4] = bblCell.content.length != 0 ? bblCell.content : null;
                break;
            case 5:
                sheetData[5] = bblCell.inputValue.length != 0 ? bblCell.inputValue : null;
                break;
            case 6:
                sheetData[6] = bblCell.inputValue.length != 0 ? bblCell.inputValue : null;
                break;
            case 7:
                sheetData[7] = bblCell.content.length != 0 ? 'Debit' : 'Credit';
                break;
            case 9:
                sheetData[8] = parseFloat('0' + bblCell.content.replace(/\(|\)/g, ""));
                break;
        }

    }
    await Promise.all([
        sheetData[0] = requestFor,
        cells = JSON.stringify(sheetData),
        sheetData
    ]);
    if (sheetData[1] != null) modifyLedger(parent, range);

}
var count = 0;

async function modifyLedger(parent, range) {
    let DBStatus = parent.shadowRoot.querySelector('.column-status').querySelector('.span0');
    var xhhtp = new XMLHttpRequest();
    var temp = JSON.parse(cells);
    let arrCells = parent.querySelectorAll(`bbl-cell[row="${range}"]`);
    xhhtp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            count = this.responseText.indexOf('successfull') > -1 ? count + 1 : count + 0;
            DBStatus.innerText = 'Status: ' + temp[0] + ' successfull for :' + count + ' record(s)';
            if (temp[0] == 'delete') {
                for (let c of arrCells) {
                    if([2,5,6].includes(c.col)){
                    c.inputValue=null;
                    }
                    else{
                        c.content = '';
                    }
                }
               
            }
             let cboxCol = parent.querySelector(`bbl-checkbox[row="${range}"][col="0"]`).shadowRoot.querySelector('div').querySelector('input');
                    cboxCol.checked = false;
        }
    }
    xhhtp.withCredentials = true;
    xhhtp.open('POST', 'database/modifyLedger.php', true);
    let query = null;
    if (temp[0] == 'update') {
        query = temp[7] == "Debit" ? `update \`${db}_ledger\` set logdate ='${temp[2]}' ,item_name='${temp[3]}' ,detail='${temp[4]}',itm_count=${temp[5]},item_rate=${temp[6]},debit=1,credit=0,balance=${temp[8]} where transaction_id='${temp[1]}'` :
            `update \`${db}_ledger\` set logdate ='${temp[2]}' ,item_name='${temp[3]}' ,detail='${temp[4]}',itm_count=${temp[5]},item_rate=${temp[6]},debit=0,credit=1,balance=${temp[8]} where transaction_id='${temp[1]}'`;
    } else {
        query = `delete from \`${db}_ledger\` where transaction_id='${temp[1]}'`;
    }
    await Promise.all([DBStatus, xhhtp, temp, query, count, arrCells]);
    xhhtp.send(query);
};


let inven = null;


const outputHTML = matches => {
    if (matches.length != 0) {
        const html = matches.map(match =>
            match
        ).join(',');
        autoCompleteHTML.push(html);
    }
};


class formullaBar extends HTMLElement {
    __bar = [];
    constructor() {
        super();
        this.attachShadow({
            mode: 'open'
        });
        this.shadowRoot.innerHTML = document.querySelector('#formulla').innerHTML;
        let barElement = this.shadowRoot.querySelector('div');
        var operators = ['DATE(s)', /*'EXPENSE', 'INCOME',*/ 'RATE', 'COUNT', 'NAME', 'BALANCE', 'DETAIL', 'AND', 'ID'];
        let matches = null,
            andQuery = '',
            nxtQuery = '',
            ledger = document.querySelector('bbl-ledger'),
            clientQuery = '';

        const operator = txt => {
            matches = operators.filter(item => {
                const regex = new RegExp(`^${txt}`, 'gi');
                return item.match(regex);
            });
        }


        this.shadowRoot.querySelector('div').addEventListener('keydown', async (e) => {
            if (barElement.innerText.length < 2 && e.key == 8)
                andQuery, nxtQuery = null;

            if (barElement.innerText.length < 7) {
                operator(barElement.innerText);
            } else if (barElement.innerText.indexOf('AND') > 0) {
                nxtQuery += e.key.length < 2 ? e.key : '';
                andQuery = "";
                operator(nxtQuery.replace('null', '').trim());
            } else {
                nxtQuery = " ";
                andQuery += e.key.length < 2 && e.key == 'a' || e.key == 'n' || e.key == 'd' ? e.key : '';
                operator(andQuery.trim());
            }
            barElement.setAttribute('placeholder', matches[0]);

            switch (e.keyCode) {
                case 13:
                    e.preventDefault();
                    this.runQuery(barElement.innerText);
                    break;
                case 9:
                    e.preventDefault;
                    andQuery, nxtQuery = null;
                    this.autocompleteFormulla(barElement, matches);
                    break;
            }
        });
        this.shadowRoot.querySelector('div').addEventListener('keyup', async (e) => {
            if (e.keyCode == 8 && barElement.innerText.length < 1) {
                matches = null, andQuery = '', nxtQuery = '';
            }
        });
    };

    autocompleteFormulla(cell, arr) {
        switch (arr[0]) {
            case 'DATE(s)':
                this.clientQuery = cell.innerText.indexOf('AND') < 2 ? arr[0] + '\xa0' + '::' + '\xa0' + 'TO::' + '\xa0' : this.clientQuery + ' ' + arr[0] + '\xa0' + '::' + '\xa0' + 'TO::' + '\xa0';
                break;
           /* case 'EXPENSE':
                this.clientQuery = cell.innerText.indexOf('AND') < 2 ? arr[0] + ' FROM::' + ' TO::' : this.clientQuery + ' ' + arr[0] + ' FROM:: ' + 'TO:: ';
                break;
            case 'INCOME':
                this.clientQuery = cell.innerText.indexOf('AND') < 2 ? arr[0] + ' FROM::' + ' TO::' : this.clientQuery + ' ' + arr[0] + ' FROM:: ' + 'TO:: ';
                break;*/
            case 'RATE':
                this.clientQuery = cell.innerText.indexOf('AND') < 2 ? arr[0] + ' FROM::' + ' TO::' : this.clientQuery + ' ' + arr[0] + ' FROM:: ' + 'TO:: ';
                break;
            case 'COUNT':
                this.clientQuery = cell.innerText.indexOf('AND') < 2 ? arr[0] + ' FROM::' + ' TO::' : this.clientQuery + ' ' + arr[0] + ' FROM:: ' + 'TO:: ';
                break;
            case 'NAME':
                this.clientQuery = cell.innerText.indexOf('AND') < 2 ? arr[0] + ' LIKE:: ' : this.clientQuery + ' ' + arr[0] + ' LIKE:: ';
                break;
            case 'DETAIL':
                this.clientQuery = cell.innerText.indexOf('AND') < 2 ? arr[0] + ' LIKE:: ' : this.clientQuery + ' ' + arr[0] + ' LIKE:: ';
                break;
            case 'BALANCE':
                this.clientQuery = cell.innerText.indexOf('AND') < 2 ? arr[0] + ' FROM:: ' + 'TO:: ' : this.clientQuery + ' ' + arr[0] + ' FROM:: ' + 'TO:: ';
                break;
            case 'AND':
                this.clientQuery = this.clientQuery + ' ' + ' AND';
                break;
            case 'ID':
                this.clientQuery = cell.innerText.indexOf('AND') < 2 ? arr[0] + ' :: ' : this.clientQuery + ' ' + arr[0] + ' ::';
                break;
        }
        cell.innerText = this.clientQuery;
    }

    runQuery(query) {

        var queries = query.split('AND');
        for (let q = 0; q < queries.length; q++) {
            var queryParts = queries[q].split(':');
            switch (queryParts[0].trim()) {
                case "DATE(s)":
                    query = q == 0 ? `select * from \`${db}_ledger\` where logdate between '${queryParts[1]}' and '${queryParts[3]}'` : query + `and logdate between '${queryParts[1]}' and '${queryParts[3]}'`;
                    break;

                case "DEBIT FROM":
                    query = q == 0 ? `SELECT * FROM \`${db}_ledger\` WHERE (item_rate*itm_count) between ${queryParts[1]} and ${queryParts[3]} and debit=1` : query + ` and (item_rate*itm_count) between ${queryParts[1]} and ${queryParts[3]} and debit=1`;
                    break;

                case "CREDIT FROM":
                    query = q == 0 ? `SELECT * FROM \`${db}_ledger\` WHERE (item_rate*itm_count) between ${queryParts[1]} and ${queryParts[3]} and credit=1` : query + ` and (item_rate*itm_count) between ${queryParts[1]} and ${queryParts[3]} and credit=1`;
                    break;

                case "RATE FROM":
                    query = q == 0 ? `select * from \`${db}_ledger\` where item_rate between ${queryParts[1]} and ${queryParts[3]}` : query + ` and item_rate between ${queryParts[1]} and ${queryParts[3]}`;
                    break;

                case "COUNT FROM":
                    query = q == 0 ? `select * from \`${db}_ledger\` where itm_count between ${queryParts[1]} and ${queryParts[3]}` : query + ` and itm_count between ${queryParts[1]} and ${queryParts[3]}`;
                    break;

                case "NAME LIKE":
                    query = q == 0 ? `select * from \`${db}_ledger\` where item_name like'%${queryParts[1]}%'` : query + ` and where item_name like'%${queryParts[1]}%'`;
                    break;

                case "DETAIL LIKE":
                    query = q == 0 ? `select * from \`${db}_ledger\` where detail like'${queryParts[1]}'` : query + ` and where detail like'${queryParts[1]}'`;
                    break;

                case "BALANCE FROM":
                    query = q == 0 ? `select * from \`${db}_ledger\` where balance between ${queryParts[1]} and ${queryParts[3]}` : query + ` and where balance between ${queryParts[1]} and ${queryParts[3]}`;
                    break;

            }

        }
        let DBStatus = ledger.shadowRoot.querySelector('.column-status').querySelector('.span0');
        var xhhtp = new XMLHttpRequest();
        xhhtp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                let parsedData = JSON.parse(this.responseText);
                if (currentSheetLedger.length < 1)
                    backupInVariable(ledger);

                setLedger(ledger, parsedData);

            }
        }
        xhhtp.withCredentials = true;
        xhhtp.open('POST', 'database/fetchQuery.php', true);
        xhhtp.send(query);

    }
};

window.customElements.define('bbl-formulla', formullaBar);
window.customElements.define('bbl-ledger', LedgerElement);
window.customElements.define('bbl-cell', CellElementLedger);
window.customElements.define('bbl-checkbox', CheckboxElement);



async function generateCells(rowCount, totalRows) {
    let html = '';
    let ledger = document.querySelector('#ledger');
    for (let r = rowCount; r <= totalRows; r++) {
        for (let c = 0; c < 10; ++c) {
            if (c == 0) {
                html += `<bbl-checkbox slot="checkbox" row="${r}" col="${c}" tabindex="0" contentType ="input" enabled="false"></bbl-checkbox>`;
            } else if (c == 10 || c == 1 || c == 9) {
                html += `<bbl-cell slot="cells" row="${r}" col="${c}" tabindex="0" contentType ="text"></bbl-cell>`;
            } else if (c == 2) {
                html += `<bbl-cell slot="cells" row="${r}" col="${c}" tabindex="0" contentType ="date" enabled="false"></bbl-cell>`;
            } else if (c == 5 || c == 6) {
                html += `<bbl-cell slot="cells" row="${r}" col="${c}" tabindex="0" contentType ="text" enabled="false" values="numeric"></bbl-cell>`;
            } else {
                html += `<bbl-cell slot="cells"  row="${r}" col="${c}" contentType ="text" tabindex="0"></bbl-cell>`;
            }
        }
    }
    ledger.innerHTML = html;
    await Promise.all([html, ledger]);
}

async function generatePage() {
    await Promise.all([
        fetchInventory(),
        generateCells(1, 100)
    ]);
}
generatePage();