const host = "http://localhost:8000/api";
const checklistContainer = document.getElementById('checklist-container');
const checklistName = document.getElementById('checklist-name');
const checklistDesc = document.getElementById('checklist-desc');
const newChecklistBtn = document.getElementById('new-checklist-btn');
const checklistTaskFlex = document.getElementById('checklist-task-flex');
const addTask = document.getElementById('add-task');

window.addEventListener('load', () => {
    console.log('List loaded');
    loadlists();
})

function loadlists(name, description) {
    checklistContainer.innerHTML = "";
    checklistTaskFlex.innerHTML = "";
    apiRequest(host + '/checklists', 'GET',{ name, description })
        .then(data => {
            const table = document.createElement("table");

            const headerRow = document.createElement("tr");
            const nameHeader = document.createElement("th");
            nameHeader.innerHTML = 'Name';
            const descHeader = document.createElement('th');
            descHeader.innerHTML = 'Description';
            headerRow.appendChild(nameHeader);
            headerRow.appendChild(descHeader);
            table.appendChild(headerRow);

            for (const checklist of data) {
                const row = document.createElement('tr');
                const nameCell = document.createElement('td');
                nameCell.textContent = checklist.name;
                const descCell = document.createElement('td');
                descCell.textContent = checklist.description;
                row.appendChild(nameCell);
                row.appendChild(descCell);
                table.appendChild(row);
        }

            checklistContainer.appendChild(table);
    })
}

newChecklistBtn.addEventListener('click', () => {
    const name = checklistName.value;
    const description = checklistDesc.value;

    apiRequest(host + '/checklists', 'POST', { name, description })
        .then(() => {
            checklistName.value = '';
            checklistDesc.value = '';
            loadlists();
        })
})
