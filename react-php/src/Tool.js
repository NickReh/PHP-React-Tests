import React from "react";
import { useState } from "react";
import "./Components.css";

function Tool (props) {
    const [selected, setSelected] = useState(false);

    const toolClicked = () => {
        setSelected(true)
    };

    return (
        <div className={"tool" + (selected ? " selected" : "")} onClick={toolClicked}>{props.tool.name}</div>
    );
}

export default Tool;