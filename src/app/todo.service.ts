import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { environment } from 'src/environments/environment';
import { Observable } from 'rxjs';
import { map } from "rxjs/operators"
import { Todo } from './todo';
const url = environment.apiUrl;
@Injectable({
  providedIn: 'root'
})
export class TodoService {

  constructor(private _http:HttpClient) { }

  getTodos():Observable<Todo[]>{
    return this._http.get(`${url}/todo`).pipe(map((data:any)=>{ return data.data as Todo[] }))
  }

  createTodo(data:any):Observable<Todo>{
    return this._http.post(`${url}/todo`,data).pipe(map((data:any)=>{ return data.data as Todo }))
  }

  updateTodo(data:Todo):Observable<Todo>{
    return this._http.patch(`${url}/todo/${data.id}`,data).pipe(map((data:any)=>{ return data.data as Todo }))
  }

  deleteTodo(data:Todo):Observable<Todo>{
    return this._http.delete(`${url}/todo/${data.id}`).pipe(map((data:any)=>{ return data.data as Todo }))
  }
}
