const host = "http://localhost:8000/api";
const checklistContainer = document.getElementById('checklists-container');
const checklistName = document.getElementById('checklist-name');
const checklistDesc = document.getElementById('checklist-desc');
const newChecklistBtn = document.getElementById('new-checklist-btn');
const checklistTaskFlex = document.getElementById('checklist-task-flex');

window.addEventListener('load', () => {
    console.log('List loaded');
    loadChecklists();
    loadChecklistTasks();
})

function loadChecklists(name, description) {
    checklistContainer.innerHTML = "";
    checklistTaskFlex.innerHTML = "";
    apiRequest(host + '/checklists', 'GET', {})
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
                nameCell.innerHTML = checklist.name;
                const descCell = document.createElement('td');
                descCell.innerHTML = checklist.description;
                row.appendChild(nameCell);
                row.appendChild(descCell);
                table.appendChild(row);
        }
        checklistContainer.appendChild(table);
    })
}

function loadChecklistTasks(checklistId) {
    checklistTaskFlex.innerHTML = "";
    apiRequest(host + '/tasks' , 'GET', {})
    .then(data => {
        for (const checklist of data) {
            const div = document.createElement("div");
            const table = document.createElement("table");
            const taskList = document.createElement('ul');

            const checklistNameRow = document.createElement("tr");
            const checklistNameCell = document.createElement("td");
            checklistNameCell.innerHTML = checklist.name;
            checklistNameRow.appendChild(checklistNameCell);
            table.appendChild(checklistNameRow);

            for (const task of checklist.tasks) {
                taskList.appendChild(createTaskListItem(task));
            }

            table.appendChild(taskList);

            const newTaskListItem = document.createElement('li');
            const newTaskInput = document.createElement('input');
            newTaskInput.type = "text";
            newTaskInput.placeholder = "New Task";
            newTaskListItem.appendChild(newTaskInput);
            table.appendChild(newTaskListItem);
            
            newTaskInput.addEventListener('keydown', (event) => {
                if (event.key === 'Enter') {
                    event.preventDefault();
                    const body = {
                        name: newTaskInput.value,
                        checklist_id: checklist.id
                    };
                    apiRequest(host + '/tasks', 'POST', body)
                        .then(task => {
                            newTaskInput.value = "";
                            taskList.appendChild(createTaskListItem(task));
                        })
                        .catch(error => {
                            console.error("Error creating task:", error);
                        });
                }
            });

            div.appendChild(table);
            checklistTaskFlex.appendChild(div);

        }
    })
}

function createTaskListItem(task) {
    const taskListItem = document.createElement('li');
    const taskCheckbox = document.createElement('input');
    taskCheckbox.type = 'checkbox';
    taskCheckbox.checked = task.is_completed;

    taskCheckbox.addEventListener('change', () => {
        const body = {
            is_completed: taskCheckbox.checked
        };
        apiRequest(host + `/tasks/${task.id}`, 'PUT', body)
            .then(() => {
                console.log("Task updated successfully");
            })
            .catch(error => {
                console.error("Error updating task:", error);
            });
    });

    const taskName = document.createElement('span');
    taskName.innerHTML = task.name;
    taskName.contentEditable = true;
    taskName.addEventListener('blur', () => {
        const body = {
            name: taskName.innerHTML
        };
        apiRequest(host + `/tasks/${task.id}`, 'PUT', body)
            .then(() => {
                console.log("Task updated successfully");
            })
            .catch(error => {
                console.error("Error updating task:", error);
            });
    });

    taskListItem.appendChild(taskCheckbox);
    taskListItem.appendChild(taskName);

    return taskListItem;
}



newChecklistBtn.addEventListener('click', () => {
    const body = {
        name: checklistName.value,
        description: checklistDesc.value
    };

    apiRequest(host + '/checklists', 'POST', body)
        .then(() => {
            checklistName.value = "";
            checklistDesc.value = "";
            loadChecklists();
            loadChecklistTasks();
        })
        .catch(error => {
            console.error("Error creating checklist:", error);
        });
});