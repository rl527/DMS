/*@desc users profile validations
  @author susmitha
  @date June 21/18
  @param string input*/

function readURL(input)
{
        if (input.files && input.files[0])
        {
            var reader = new FileReader();
            reader.onload = function (e)
            {
                $('.image')
                        .attr('src', e.target.result)
                        .width(200)
                        .height(200);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
    var checkme = document.getElementById('checker');
    var userImage = document.getElementById('image-input');
    var userName = document.getElementById('name');
    var email = document.getElementById('Email');
    var deptId = document.getElementById('DepId');
    var mobile = document.getElementById('tel');
    var status = document.getElementById('isActive');
    var userSend = document.getElementById('submit');
    // var editPic = document.getElementById('PicUpload');

    /*@desc disabling the users profile fields for editing*/
    
    checkme.onchange = function()
    {
        userSend.disabled = !this.checked;
        userImage.disabled = !this.checked;
        userName.disabled = !this.checked;
        email.disabled = !this.checked;
        deptId.disabled = !this.checked;
        mobile.disabled = !this.checked;
        //editPic.style.display = this.checked ? 'block' : 'none';
    };