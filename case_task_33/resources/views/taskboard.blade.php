<x-app-layout>
  <x-slot name="header">
    <h2 class="text-gray-800 text-xl font-semibold leading-tight">{{ __('Task Board') }}</h2>
  </x-slot>
  <div class="py-12">
    <div class="mx-auto max-w-7xl lg:px-8 sm:px-6">
      <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
        <div class="border-gray-200 border-b bg-white p-6">
          <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
            <div id="todo" class="bg-gray-100 rounded-lg p-4 shadow">
              <h3 class="text-blue-600 mb-4 text-lg font-semibold">На исполнение</h3>
              <div class="task-column space-y-4">
                <!-- Задачи будут вставлены сюда -->
              </div>
            </div>
            <div id="in_progress" class="bg-gray-100 rounded-lg p-4 shadow">
              <h3 class="text-yellow-600 mb-4 text-lg font-semibold">В работе</h3>
              <div class="task-column space-y-4">
                <!-- Задачи будут вставлены сюда -->
              </div>
            </div>
            <div id="done" class="bg-gray-100 rounded-lg p-4 shadow">
              <h3 class="text-green-600 mb-4 text-lg font-semibold">Сделано</h3>
              <div class="task-column space-y-4">
                <!-- Задачи будут вставлены сюда -->
              </div>
            </div>
          </div>
          <div class="mt-8">
            <h3 class="mb-4 text-lg font-bold">Добавить новую задачу</h3>
            <form id="task-form" class="space-y-4">
              @csrf
              <div>
                <label for="title" class="text-gray-700 block text-sm font-medium"
                  >Заголовок задачи</label
                >
                <input
                  type="text"
                  name="title"
                  id="title"
                  placeholder="Enter task title"
                  class="border-gray-300 focus:ring-blue-500 focus:border-blue-500 mt-1 block w-full rounded-md border p-2 shadow-sm"
                  required
                />
              </div>
              <div>
                <label for="description" class="text-gray-700 block text-sm font-medium"
                  >Описание задачи</label
                >
                <textarea
                  name="description"
                  id="description"
                  placeholder="Enter task description"
                  class="border-gray-300 focus:ring-blue-500 focus:border-blue-500 mt-1 block w-full rounded-md border p-2 shadow-sm"
                ></textarea>
              </div>
              <input type="hidden" name="status" value="todo" />
              <div>
                <button
                  type="submit"
                  class="bg-blue-500 hover:bg-blue-600 focus:ring-blue-500 w-full rounded-md px-4 py-2 text-white shadow focus:outline-none focus:ring-2 focus:ring-offset-2"
                >
                  Добавить задачу
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const taskForm = document.getElementById('task-form');
      const columns = ['todo', 'in_progress', 'done'];
      function addTaskToColumn(task) {
        const column = document.querySelector(`#${task.status} .task-column`);
        const taskElement = document.createElement('div');
        taskElement.id = `task-${task.id}`;
        taskElement.className = 'bg-white p-4 rounded-lg shadow';
        taskElement.innerHTML = `
                    <h4 class="font-semibold text-lg mb-2">${task.title}</h4>
                    <p class="text-gray-600 mb-4">${task.description || 'No description'}</p>
                    <select class="task-status w-full p-2 border border-gray-300 rounded-md" data-task-id="${task.id}">
                        ${columns.map((status) => `<option value="${status}" ${status === task.status ? 'selected' : ''}>${status.replace('_', ' ')}</option>`).join('')}
                    </select>
                `;
        column.appendChild(taskElement);
      }
      function loadTasks() {
        axios
          .get('/tasks')
          .then((response) => {
            response.data.forEach(addTaskToColumn);
          })
          .catch((error) => {
            console.error('Error loading tasks:', error);
          });
      }
      taskForm.addEventListener('submit', function (e) {
        e.preventDefault();
        const formData = new FormData(this);
        axios
          .post('/tasks', Object.fromEntries(formData))
          .then((response) => {
            this.reset();
            addTaskToColumn(response.data);
          })
          .catch((error) => {
            console.error('Error creating task:', error);
          });
      });
      document.addEventListener('change', function (e) {
        if (e.target.classList.contains('task-status')) {
          const taskId = e.target.dataset.taskId;
          const newStatus = e.target.value;
          axios
            .put(`/tasks/${taskId}`, { status: newStatus })
            .then((response) => {
              const taskElement = document.getElementById(`task-${taskId}`);
              if (taskElement) {
                taskElement.remove();
              }
              addTaskToColumn(response.data);
            })
            .catch((error) => {
              console.error('Error updating task:', error);
            });
        }
      });
      Echo.channel('taskboard')
        .listen('TaskCreated', (e) => {
          addTaskToColumn(e.task);
        })
        .listen('TaskUpdated', (e) => {
          const taskElement = document.getElementById(`task-${e.task.id}`);
          if (taskElement) {
            taskElement.remove();
          }
          addTaskToColumn(e.task);
        });
      loadTasks();
    });
  </script>
</x-app-layout>