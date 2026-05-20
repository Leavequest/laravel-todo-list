<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <script src="/js/api.js" defer></script>
    <script src="/js/main.js" defer></script>

    <header class="index-header">
        <h1>To-Do List</h1>
    </header>

    <section class="checklists-section">
        <div>
            <h2>All lists</h2>
            <div id="checklists-container"></div><br>
        </div>
    </section>

    <section class="checklists-section">
        <h2>Create New List</h2>
        <div class="checklists-form">
            <input type="text" class="form-input" name="checklist-name" id="checklist-name" placeholder="Name:">
            <input type="text" class="form-input" name="checklist-desc" id="checklist-desc" placeholder="Description:">
            <button id="new-checklist-btn">+</button>
        </div>
    </section>

    <section class="checklists-section">
        <h2>Tasks</h2>
        <div id="checklist-task-flex">

        </div>
    </section>
        
    <input type="text" name="add-task" id="add-task" placeholder="Task:">

</body>
</html>