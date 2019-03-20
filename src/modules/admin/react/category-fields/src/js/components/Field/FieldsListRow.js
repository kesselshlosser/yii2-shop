import React, { Component } from 'react';
import { connect } from 'react-redux';

import {label} from "../../constants/FieldType";

class FieldsListRow extends Component {
  render() {
    const { model, groupName } = this.props;

    return (
        <div className="list-row">
          <div className="field-list__name">
            {model.name}
          </div>
          <div className="field-list__group">
            {groupName}
          </div>
          <div className="field-list__type">
            {label(model.type)}
          </div>
          <div className="field-list__actions">
            <button className="field-list__action btn btn-mini btn-primary">Редактировать</button>
            <button className="field-list__action btn btn-mini btn-danger">Удалить</button>
          </div>
        </div>
    );
  }
}

function mapStateToProps(state, ownProps) {
  const { model } = ownProps;

  const group = model.group_id ? state.groups.entities.find(item => item.id === model.group_id) : null;

  return {
    groupName: group ? group.name : null
  }
}

export default connect(mapStateToProps)(FieldsListRow);
