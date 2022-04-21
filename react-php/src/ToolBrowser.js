import React from "react";
import { useState, useEffect } from "react";
import Category from "./Category";
import Tool from "./Tool";
import RequestService from "./RequestService";
import "./Components.css";


function ToolBrowser() {
    const [categories, setCategories] = useState([]);
    const [tools, setTools] = useState([]);
    const [breadcrumb, setBreadcrumb] = useState([]);
    const [showTools, setShowTools] = useState(false);
    const requestService = new RequestService();

    useEffect(() => {
        requestService.execute("categories_get").then(data => {
            setCategories(data);
        });
    }, []);

    //determine whether to show all categories or an open category's tools

    const categoryClicked = (category) => {
        if (category) {
            setBreadcrumb(prevArr => { return [...prevArr, category] });
        } else {
            setBreadcrumb([]);
        }

        if(category.childCategories && category.childCategories.hasOwnProperty(1)){
            let childCategories = Object.keys(category.childCategories).map(i => category.childCategories[i]); //php returning it as object instead of array so switch it
            setCategories(childCategories);
        }
        else if (category.hasTools) {
            requestService.execute("tools_get", {"categoryId": category.id}).then(data => {
                setTools(data);
                setShowTools(true);
            });
        }
    };

    return (
        <div className="toolBrowser"> 
            <div id="controls"></div>

            {!showTools &&
            categories.map(category => {
                return <Category key={category.id} category={category} categoryOnClick={categoryClicked} />
            })}

            {showTools &&
            tools.map(tool => {
                return <Tool key={tool.id} tool={tool} />
            })}
        </div>
    );
}

export default ToolBrowser;