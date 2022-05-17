import ReactDOM from 'react-dom';
import React from 'react';
import { Calendar } from './Calendar';

export default class DetailDoctor {
    public render() {
        ReactDOM.render(
            React.createElement(Calendar),
            document.getElementById('calendar')
        );
    }
}
