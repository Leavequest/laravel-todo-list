<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List</title>
</head>
<body>
    
    @stack('resources/js/main.js')
    @stack('resources/js/api.js')
    
    <header>
        <h1>To-Do List</h1>
    </header>

    <div>
        <h2>All lists</h2>
        <div id="checklists-container"></div><br>
    </div>


    <section>
        <input type="text" name="checklist-name" id="checklist-name" placeholder="Name:">
        <input type="text" name="checklist-desc" id="checklist-desc" placeholder="Description:">
    </section><br>
    
    <div>
        <button id="new-checklist-btn">+</button> Add list
        <div id="checklist-task-flex"></div>
    </div>
    <br>

    <input type="text" name="add-task" id="add-task" placeholder="Task:">

    
    
</body>
</html>