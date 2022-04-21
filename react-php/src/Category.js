import React from "react";
import { useState, useEffect } from "react";

import RequestService from "./RequestService";
import "./Components.css";

function Category (props) {
    const requestService = new RequestService();

    return (
        <div className="category" onClick={props.categoryOnClick.bind(this, props.category)}>
            {props.category.name}
        </div>
    );
}

export default Category;