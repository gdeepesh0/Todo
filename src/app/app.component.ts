import { Component, OnInit } from '@angular/core';
import { TodoService } from './todo.service';
import { Todo } from './todo';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.scss']
})
export class AppComponent implements OnInit{
  title = 'todo';
  todos:Todo[];
  constructor(private _todo:TodoService){}

  async ngOnInit(){
    this.todos = await this._todo.getTodos().toPromise();
  }

  async addTodo(input){
    let res = await this._todo.createTodo({title:input.value}).toPromise();
    this.todos.push(res);
    input.value = '';
  }

  async deleteTodo(index){
    await this._todo.deleteTodo(this.todos[index]).toPromise().catch(err=>{
      console.log(err);
    })
    this.todos.splice(index,1)
  }

  async updateStatus(index){
    this.todos[index].status = 'complete';
    await this._todo.updateTodo(this.todos[index]).toPromise();
  }

  async updateTodo(todo){
    await this._todo.updateTodo(todo).toPromise();
  }
}
